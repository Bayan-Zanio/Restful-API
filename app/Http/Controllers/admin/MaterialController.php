<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {  // اظهار المعلمات التابعة للصف
        $material=Material::orderBy('name','asc')->get();
        return view('admin.material.index',
        [
            'material'=>$material,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.material.create',[
        'material' => new Material(),
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate(
            [
                'name'  => 'required|string|max:20',
            ]
        );
        
        $material=new Material();
        $material->name=$request->name;  
        $material->save();
        
        session()->flash('success','Material added!');
        return redirect(route('admin.material.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::findOrFail($id);
        
        return view('admin.material.show',
        [
            'material' => $material,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Material::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.material.index')
        ->with('success' , 'material deleted');
    }


    public function material()
    {  // اظهار المعلمات التابعة للصف
        $material=Material::orderBy('name','asc')->get();
        return response()->json(['code'=>201 ,'status'=>true , 'data'=>$material]);
    }
}
