<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FCM;
use App\Http\Controllers\Controller;
use App\Models\Claas;
use App\Models\Evaluations;
use App\Models\Images;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class EvaluationsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('store');
    }
    public function index()
    {
        $evaluations =  Evaluations::with('user')->get();
        // $t=Auth::user()->id;
        return response()->json($evaluations);
    }

    public function indexx(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $evaluations = Evaluations::where('user_id', '=', $id)->with('teacher')->get();
        

        return response()->json($evaluations);
    }

    public function evaluationsstudent(Request $request, $id)
    {
        $class=Claas::findOrFail($id);
        
        $users = User::whereHas('claas', function($query) use ($id){
            $query->where('claas_id', '=', $id);
        })->where('type','=','student')->with('evaluations')->get();
        
        
        
        //return response()->json($user,$users);
        return response()->json(['code'=>201 ,'status'=>true , 'data'=>$users ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'evaluation' => 'required',
            // 'teacher_id' => 'required',
            'user_id' => 'required',
            'personal_cleanliness' => 'required',
            'punctuality' => 'required',
            'homework' => 'required',
            'share' => 'required',
            'notes' => 'required',
        ]);
        
        //$evaluations = Evaluations::create($request->all());
       
        $evaluations = new Evaluations;
        $evaluations->evaluation = $request->get('evaluation');
        $evaluations->teacher_id = Auth::user()->id;
        $evaluations->user_id = $request->get('user_id');
        $evaluations->personal_cleanliness = $request->get('personal_cleanliness');
        $evaluations->punctuality = $request->get('punctuality');
        $evaluations->homework = $request->get('homework');
        $evaluations->share = $request->get('share');
        $evaluations->notes = $request->get('notes');
        // $product->date = Carbon::now()->format('H:i:s');
        

        $evaluations->save();

        //$evaluations->refresh();

        $users = User::where('id','=',$evaluations->user_id)->where('type','=','student')->get()->pluck('id')->toArray();
        $query = UserDevice::query();
        $user_fcm_tokens = $query->whereIn('user_id', $users)->where('status', 1)->pluck('fcm_token')->toArray();
        $title = 'تقييم طفلك';
        $content = 'تم تقييم طفلك';
        $date = $evaluations->created_at;
        FCM::push($user_fcm_tokens, $title, $content , $date);

        //return response()->json($product , 201);
        // return Response::json($evaluations , 201);
        return response()->json(['code' => 201, 'message' => 'لقد تم تقييم الطالب بنجاح' , 'data' => $evaluations]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Evaluations::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $evaluations = Evaluations::findOrFail($id);
        $evaluations->update($request->all());

       

        //return response()->json($product , 201);
        return Response::json([
            'message' => 'evaluations updated',
            'data' => $evaluations,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user->tokenCan('evaluations.create'))
        {
            return Response::json([
                'message' => 'Forbidden'
            ], 403);
        }


        $evaluations = Evaluations::findOrFail($id);
        $evaluations->delete();
        return Response::json([
            'message' => 'evaluations deleted',
            'data' => $evaluations,
        ]);
    }
}
