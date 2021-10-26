<?php

namespace App\Http\Responses;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Api\HomeworkController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginInterface;

class LoginResponse implements ContractsLoginInterface
{
    public function toResponse($request)
    {
        $user = $request->user();
        $user = Auth::user();

        if ($user->type == 'admin')
        {
            return redirect()->route('admin.home.index');
        }

        return redirect()->route('login');
    }

   
}