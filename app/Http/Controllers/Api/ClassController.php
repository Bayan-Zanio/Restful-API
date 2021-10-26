<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Claas;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class =  Claas::with('user')->withCount('user')->get();
        
         
        // return response()->json($class);
        return response()->json(['code'=>201 ,'status'=>true , 'data'=>$class]);
    }

    public function indexx($id)
    {
        // $class =  Claas::with('user')->withCount('user')->get();
        // $user = User::where('id','=',$id)->with('claas')->get();

        $users = User::whereHas('claas', function($query) use ($id){
            $query->where('claas_id', '=', $id);
        })->where('type','=','student')->get()->count();
        $users = User::whereHas('claas', function($query) use ($id){
            $query->where('claas_id', '=', $id);
        })->where('type','=','student')->get()->count();

        $user = Claas::whereHas('user', function($query) use ($id){
            $query->where('id', '=', $id);
        })->get();
        
         
        // return response()->json($class);
        return response()->json(['code'=>201 ,'status'=>true , 'gd'=>$users , 'data'=>$user]);
    }

    public function student()
    {
        // $class=Claas::findOrFail($id);
        $class =  Claas::withCount(['user'=>function($query){
            $query->where('type', '=', 'student');
        }])->get();
        
 
        return response()->json(['code'=>201 ,'status'=>true  , 'data'=>$class ]);
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
    public function show($id)
    {
        //
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
        //
    }
}
