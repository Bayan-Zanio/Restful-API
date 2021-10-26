<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claas;
use App\Models\Season;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  // اظهار المعلمات التابعة للصف
        $parents=Claas::orderBy('seasons_name','asc')->get();
        return view('admin.class.index',
        [
            'parents'=>$parents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.class.create',[
        'claas' => new Claas(),
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
                'seasons_name'  => 'required|string|max:20',
            ]
        );
        
        $claas=new Claas();
        $claas->seasons_name=$request->seasons_name;  
        $claas->save();
        
        session()->flash('success','Class added!');
        return redirect(route('admin.class.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $claas = Claas::findOrFail($id);
        
        return view('admin.class.show',
        [
            'claas' => $claas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $claas=Claas::findOrFail($id);  
      
      
      $parents=Claas::where('id','<>',$id)->orderBy('seasons_name','asc')->get();

      return view('admin.class.edit',
    [
        'id'=>$id,
        'claas'=>$claas,
        'parents'=>$parents, 
    ]
    );
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
        $role = Claas::findOrFail($id);

        $role->update($request->all());

        return redirect()->route('admin.class.index')
        ->with('success' , 'Class updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Claas::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.class.index')
        ->with('success' , 'Class deleted');
    }
}
