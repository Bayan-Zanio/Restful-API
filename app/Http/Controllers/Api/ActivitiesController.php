<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FCM;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Claas;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities =  Activities::with('images')->paginate(10);
        // return response()->json($activities);
        return response()->json(['code' => 200, 'status' => true, 'data' => $activities]);
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
            'seasons_name' => 'required',
            'name' => 'required',
            'activities_goal' => 'required',
            'duration' => 'required',
            'details' => 'required',
        ]);


        $activities = Activities::create($request->all());

        $activities->save();
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $image_path = $file->store('/images', [
                    'disk' => 'uploads'
                ]);

                // $image=new Images([
                //     'image_path'=>$image_path,
                // ]);
                $activities->Images()->create([
                    'image_path' => $image_path,
                ]);
            }
        }

        $activities->refresh();
        $users = User::whereHas('claas', function($query) use ($activities){
            $query->where('claas_id', '=', $activities->seasons_name);
        })->where('type','=','student')->get()->pluck('id')->toArray();

        $query = UserDevice::query();
        $user_fcm_tokens = $query->whereIn('user_id', $users)->where('status', 1)->pluck('fcm_token')->toArray();

        $title = 'نشاط جديد';
        $content = 'تم اضافة نشاط جديد, رقم النشاط : '.$activities->id;
        FCM::push($user_fcm_tokens, $title, $content);

        //return response()->json($product , 201);
        // return Response::json($activities, 201);
        return response()->json(['code' => 201, 'status' => true, 'message' => 'تم انشاء نشاط جديدة' , 'data' => $activities]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Activities::findOrFail($id);
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
        $request->validate([
            'seasons_name' => 'required',
            'name' => 'required',
            'activities_goal' => 'required',
            'duration' => 'required',
            'details' => 'required',
        ]);

        $activities = Activities::findOrFail($id);
        $activities->update($request->all());


        //return response()->json($product , 201);
        // return Response::json([
        //     'message' => 'activities updated',
        //     'data' => $activities,
        // ]);
        return response()->json(['code' => 201, 'status' => true, 'message' => 'activities updated', 'data' => $activities]);
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
        // if (!$user->tokenCan('activities.create')) {
        //     return Response::json([
        //         'message' => 'Forbidden'
        //     ], 403);
        // }


        $activities = Activities::findOrFail($id);
        $activities->delete();
        // return Response::json([
        //     'message' => 'activities deleted',
        //     'data' => $activities,
        // ]);
        return response()->json(['code' => 201, 'status' => true, 'message' => 'activities deleted', 'data' => $activities]);
    }

    public function activ(Request $request, $id)
    {
        $class = Claas::findOrFail($id);
        $user = Activities::where('seasons_name', '=', $id)->get();

        // return response()->json($user);
        return response()->json(['code' => 201, 'status' => true, 'data' => $user]);
    }

    public function activi(Request $request, $id)
    {
        $user = Activities::where('id', '=', $id)->get();

        // return response()->json($user);
        return response()->json(['code' => 201, 'status' => true, 'data' => $user]);
    }
}
