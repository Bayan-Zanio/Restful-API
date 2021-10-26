<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {  
        return view('admin.home.index');
    }

    public function massage()
    {  
        $massage=Messages::with('user')->get();
        return view('admin.massage.index',
        [
            'massage'=>$massage,
            
        ]);
    }

    public function massages()
    {  
        $massage=Messages::with('user')->get();
        return view('admin.massage.massage',
        [
            'massage'=>$massage,
            
        ]);
    }
}
