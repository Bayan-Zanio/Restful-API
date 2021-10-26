<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FCM;
use App\Http\Controllers\Controller;
use App\Models\Deliveries;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DeliveriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$ids)
    {
        // $deliveries =  Deliveries::with('images')->with('user')->get();
        $deliveries =  Deliveries::where('id','=',$id)->whereHas('user',function($q) use($ids) {
            $q->where('id' , '=' , $ids);
        })->get();
        // return response()->json($deliveries);
        return response()->json(['code'=>201 ,'status'=>true , 'data'=>$deliveries]);

        // $users = User::whereHas('claas', function($query) use ($request){
        //     $query->where('claas_id', '=', $request);
        // })->where('type','=','student')->get();
    }

    public function indexhomework($id,$ids)
    {
        // $deliveries =  Deliveries::where('status','=',2)->with('images')->with('user')->get();
        // $users = Homework::where('id', $id)->get()->pluck('id')->toArray();
        $deliveries = User::whereHas('claas', function($query) use ($id){
            $query->where('claas_id', '=', $id);
        })->where('type','=','student')->whereHas('deliveries',function($q) {
            $q->where('status' , '=' , 1);
        })->whereHas('deliveries', function($query) use ($ids){
            $query->where('homeworks_id', '=', $ids);
        })->get();
        return response()->json($deliveries);
        
    }

    public function homework($id,$ids)
    {
        
        $deliveries = User::whereHas('claas', function($query) use ($id){
            $query->where('claas_id', '=', $id);
        })->where('type','=','student')->whereDoesntHave('deliveries',function($query) use ($ids){
            $query->where('homeworks_id', '=', $ids);
        })->get();
        return response()->json($deliveries);
        
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
            'user_id' => 'required',
            'Notes' => 'required',
            'status' => 'required',
            'homework_id' => 'required',
        ]);
        
        $deliveries = Deliveries::create($request->all());

        $deliveries->save();
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $image_path = $file->store('/images', [
                    'disk' => 'uploads'
                ]);

                // $image=new Images([
                //     'image_path'=>$image_path,
                // ]);
                $deliveries->Images()->create([
                    'image_path' => $image_path,
                ]);
            }
        }

        $deliveries->refresh();

        // $users = User::where('type', 'teacher')->where('id', $request->id)->get()->pluck('id')->toArray();
        // $query = UserDevice::query();
        // $user_fcm_tokens = $query->whereIn('user_id', $users)->where('status', 1)->pluck('fcm_token')->toArray();
        // $title = 'تسليم السيارة';
        // $content = 'تم تسليم السيارة بنجاح';
        // FCM::push($user_fcm_tokens, $title, $content);

        //return response()->json($product , 201);
        return Response::json($deliveries , 201,);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Deliveries::findOrFail($id);
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
        $deliveries = Deliveries::findOrFail($id);
        $deliveries->update($request->all());


        //return response()->json($product , 201);
        return Response::json([
            'message' => 'Deliveries updated',
            'data' => $deliveries,
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
        if (!$user->tokenCan('Deliveries.create'))
        {
            return Response::json([
                'message' => 'Forbidden'
            ], 403);
        }


        $deliveries = Deliveries::findOrFail($id);
        $deliveries->delete();
        return Response::json([
            'message' => 'Deliveries deleted',
            'data' => $deliveries,
        ]);
    }
}
