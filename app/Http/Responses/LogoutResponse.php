<?php
 namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LogoutResponse as ContractsLogoutResponse;

// class LogoutResponse implements ContractsLogoutResponse
// {
//     public function toResponse($request)
//     {
//         $user = $request->user();
//         $user = Auth::user();

//             return redirect()->route('login');
        
//     }
// }