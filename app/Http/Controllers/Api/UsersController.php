<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Claas;
use App\Models\Evaluations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =  User::with('claas')->get();
        
        return response()->json(['code'=>201 ,'status'=>true  , 'data'=>$user,]);
    }

    public function profile($token)
    {
        $user =  User::where('id','=',$token)->get();
        $evaluations = Evaluations::where('user_id', '=', $token)->get();
        return response()->json(['code'=>201 ,'status'=>true , 'data'=>$user, 'dataa'=>$evaluations,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = DB::table('users')
                ->where('seasons_name', '=', 1)
                ->get();
        return response()->json($user);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function student(Request $request, $id)
    {
        $class=Claas::findOrFail($id);
        $user = User::whereHas('claas', function($query) use ($id){
            $query->where('claas_id', '=', $id);
        })->where('type','=','student')->get()->count();

        $users = User::whereHas('claas', function($query) use ($id){
            $query->where('claas_id', '=', $id);
        })->where('type','=','student')->get();
        
        
        
        //return response()->json($user,$users);
        return response()->json(['code'=>201 ,'status'=>true , 'count_user'=>$user , 'data'=>$users ]);
    }

    public function teacher(Request $request, $id)
    {
        $class=Claas::findOrFail($id);
        $user = User::whereHas('claas', function($query) use ($id){
            $query->where('claas_id', '=', $id);
        })->where('type','=','teacher')->get();
        return response()->json($user);
        
    }
}
