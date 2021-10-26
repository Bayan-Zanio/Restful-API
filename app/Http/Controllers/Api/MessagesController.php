<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FCM;
use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages =  Messages::with('user')->get();
        return response()->json($messages);
    }

    public function massages($id)
    {  
        $massage=Messages::with('user')->where('id','=',$id)->get();
        return response()->json($massage);
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
            'name' => 'required',
            'subject' => 'required',
            'rating' => 'nullable',
        ]);


        $messages = Messages::create($request->all());

        $messages->refresh();

        $users = User::whereHas('claas', function($query) use ($request){
            $query->where('claas_id', '=', $request);
        })->where('type','=','admin')->get();
        $query = UserDevice::query();
        $user_fcm_tokens = $query->whereIn('user_id', $users)->where('status', 1)->pluck('fcm_token')->toArray();
        $title = ' رسالة جديدة';
        $content = ' شكوى'.$messages->id;
        FCM::push($user_fcm_tokens, $title, $content);

        //return response()->json($product , 201);
        return Response::json($messages , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Messages::findOrFail($id);
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
        //
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
        if (!$user->tokenCan('Messages.create'))
        {
            return Response::json([
                'message' => 'Forbidden'
            ], 403);
        }


        $messages = Messages::findOrFail($id);
        $messages->delete();
        return Response::json([
            'message' => 'Messages deleted',
            'data' => $messages,
        ]);
    }
}
