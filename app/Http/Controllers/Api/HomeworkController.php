<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FCM;
use App\Http\Controllers\Controller;
use App\Models\Claas;
use App\Models\Homework;
use App\Models\Images;
use App\Models\User;
use App\Models\UserDevice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $currentTime = Carbon::now();
    //$currentTime->format('H:i:s');
        
        $homework =  Homework::with('images')->with('material')->get();
        
        
         return response()->json($homework);
      
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
            'name' => 'required',
            'seasons_name' => 'required',
            'details' => 'required',
            'subject_name' => 'required',
            'homework_goal' => 'required',
            'duration' => 'required',
            'gallery' => 'required',
            'materiales' => 'required',
        ]);
        //$product = Homework::create($request->all());

        $product = new Homework;
        $product->name = $request->get('name');
        $product->seasons_name = $request->get('seasons_name');
        $product->details = $request->get('details');
        $product->subject_name = $request->get('subject_name');
        $product->homework_goal = $request->get('homework_goal');
        $product->duration = $request->get('duration');
        $product->materiales = $request->get('materiales');
        //$product->date = Carbon::now()->format('H:i:s');
        

        $product->save();
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $image_path = $file->store('/images', [
                    'disk' => 'uploads'
                ]);

                // $image=new Images([
                //     'image_path'=>$image_path,
                // ]);
                $product->Images()->create([
                    'image_path' => $image_path,
                ]);
            }
        }



        //$product->refresh();

        $users = User::whereHas('claas', function($query) use ($product){
            $query->where('claas_id', '=', $product->seasons_name);
        })->where('type','=','student')->get()->pluck('id')->toArray();
        // $users = User::where('type', 'student')->where('seasons_name', $request->seasons_name)->get()->pluck('id')->toArray();
        $query = UserDevice::query();
        $user_fcm_tokens = $query->whereIn('user_id', $users)->pluck('fcm_token')->toArray();
        $title = 'واجب بيتي';
        $content = 'تم اضافة واجب جديد'.$product->name;
        $date = $product->created_at;
        FCM::push($user_fcm_tokens, $title, $content , $date);

        //return response()->json($product , 201);
        return Response::json($product, 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $h =  Homework::findOrFail($id);

        // $currentTime = Carbon::now();
        // $currentTime->format('H:i');
        
        
        
        // toDateTimeString()
        // return response()->json([$h,$currentTime]);
        return response()->json($h);
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
        $homework = Homework::findOrFail($id);
        $homework->update($request->all());


        //return response()->json($product , 201);
        return Response::json([
            'message' => 'Homework updated',
            'data' => $homework,
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
        // if (!$user->tokenCan('Homework.create')) {
        //     return Response::json([
        //         'message' => 'Forbidden'
        //     ], 403);
        // }


        $homework = Homework::findOrFail($id);
        $homework->delete();
        return Response::json([
            'message' => 'Homework deleted',
            'data' => $homework,
        ]);
    }

    public function homework(Request $request, $id)
    {
        $class=Claas::findOrFail($id);

        $user = Homework::where('seasons_name', '=', $id)->get();

        return response()->json($user);
    }
}
