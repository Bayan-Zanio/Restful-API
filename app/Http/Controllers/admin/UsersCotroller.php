<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claas;
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;


class UsersCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $parents=User::all();
        return view('admin.user.index',
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
        $user = new User();
        if (!is_null($user->materials)) {
            $tagsSelected = array_map(function($a){
                return $a['id'];
            }, $user->materials->toArray());
        }
        else 
        {
            $tagsSelected = array();
        }
        $material = Material::all();
        $claas=Claas::all();
        return view('admin.user.create',[
            'user' => new User(),
            'claas' => $claas,
            'material' => $material,
            'tagsSelected'=>$tagsSelected,
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'type' => 'required',
            'image' => 'required',
            'claas_id' => 'required',
            'material_id' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
        ]);
        // 'name',
        // 'email',
        // 'password',
        // 'type',
        // 'image',
        // 'seasons_name',
        // 'address',
        // 'gender',
        // 'phone',
        // 'date_of_birth',
        // 'material',
        
        $data = $request->all();
        $previous = false;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/images', [
                'disk' => 'uploads'
            ]);
        }
        
        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }

        $user = User::create($data);
        $user->claas()->attach($request->claas_id);
        $user->materials()->attach($request->material_id);
        
        session()->flash('success','User added!');
        return redirect(route('admin.user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return view('admin.user.show',
        [
            'user' => $user,
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
        $user = User::with(['materials','claas'])->find($id);
        
        
        if (!is_null($user->materials)) {
            $tagsSelected = array_map(function($a){
                return $a['id'];
            }, $user->materials->toArray());
        }
        else 
        {
            $tagsSelected = array();
        }


        if (!is_null($user->claas)) {
            $tagsSelected = array_map(function($a){
                return $a['id'];
            }, $user->claas->toArray());
        }
        else 
        {
            $tagsSelected = array();
        }
        
       
        $material = Material::all();
        /* if(in_array($id, $materials->id)){

        } */
      $parents=User::where('id','<>',$id)->get();

      return view('admin.user.edit',
    [
        'id'=>$id,
        'user'=>$user,
        'parents'=>$parents, 
        'claas' => Claas::all(),
        'material' => $material,
        'tagsSelected'=>$tagsSelected,
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
        $user = User::findOrFail($id);

        $data = $request->all();
        $previous = false;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/images', [
                'disk' => 'uploads'
            ]);
            $previous = $user->image;
        }

        $user->update($data);
        
        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }
        
        $user->claas()->sync($request->claas_id);
        $user->materials()->sync($request->material_id);

        return redirect()->route('admin.user.index')
        ->with('success' , 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user->image) {
            Storage::disk('uploads')->delete($user->image);
        }

        return redirect()->route('admin.user.index')
        ->with('success' , 'User deleted');
    }
}
