<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\SeasonsController;
use App\Http\Controllers\Admin\StudentsCotroller;
use App\Http\Controllers\Admin\TeacherCotroller;
use App\Http\Controllers\Admin\UsersCotroller;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\App;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified','user.type:admin'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::namespace('admin')
->prefix('admin')
->as('admin.')
->middleware('auth','user.type:admin',)
->group(function()
{
    Route::group([
        'prefix'=>'class',
        'as'=>'class.',
    ],function()
    {
        Route::get('/',[SeasonsController::class,'index'])->name('index');
        Route::get('/create',[SeasonsController::class,'create'])->name('create');
        Route::get('/(id)',[SeasonsController::class,'show'])->name('show');
        Route::post('/',[SeasonsController::class,'store'])->name('store');
        Route::get('/{id}/edit',[SeasonsController::class,'edit'])->name('edit');
        Route::put('/{id}',[SeasonsController::class,'update'])->name('update');
        Route::delete('/{id}',[SeasonsController::class,'destroy'])->name('destroy');
    }
    );



    Route::group([
        'prefix'=>'student',
        'as'=>'student.',
    ],function()
    {
        Route::get('/',[StudentsCotroller::class,'index'])->name('index');
        Route::get('/student/{id}' , [StudentsCotroller::class, 'student'])->name('student');
        Route::delete('/{id}',[StudentsCotroller::class,'destroy'])->name('destroy');
    }
    );

    Route::group([
        'prefix'=>'teacher',
        'as'=>'teacher.',
    ],function()
    {
        Route::get('/',[TeacherCotroller::class,'index'])->name('index');
        
        Route::delete('/{id}',[TeacherCotroller::class,'destroy'])->name('destroy');
    }
    );

    Route::group([
        'prefix'=>'user',
        'as'=>'user.',
    ],function()
    {
        Route::get('/',[UsersCotroller::class,'index'])->name('index');
        Route::get('/create',[UsersCotroller::class,'create'])->name('create');
        Route::get('/(id)',[UsersCotroller::class,'show'])->name('show');
        Route::post('/',[UsersCotroller::class,'store'])->name('store');
        Route::get('/{id}/edit',[UsersCotroller::class,'edit'])->name('edit');
        Route::put('/{id}',[UsersCotroller::class,'update'])->name('update');
        Route::delete('/{id}',[UsersCotroller::class,'destroy'])->name('destroy');
    }
    );

    Route::group([
        'prefix'=>'home',
        'as'=>'home.',
    ],function()
    {
        Route::get('/',[HomeController::class,'index'])->name('index');
    }
    );

   

    Route::group([
        'prefix'=>'material',
        'as'=>'material.',
    ],function()
    {
        Route::get('/',[MaterialController::class,'index'])->name('index');
        Route::get('/create',[MaterialController::class,'create'])->name('create');
        Route::get('/(id)',[MaterialController::class,'show'])->name('show');
        Route::post('/',[MaterialController::class,'store'])->name('store');
        Route::delete('/{id}',[MaterialController::class,'destroy'])->name('destroy');
    }
    );

    Route::group([
        'prefix'=>'massage',
        'as'=>'massage.',
    ],function()
    {
        Route::get('/',[HomeController::class,'massage'])->name('massage');
        Route::get('/massages',[HomeController::class,'massages'])->name('massages');
    }
    );

});

if (App::environment('production'))
{
    Route::get('/storage/{file}' , function ($file)
    {
        $path = storage_path('app/public' . $file);
        if (!is_file($path))
        {
            abort(404);
        }

        return response()->file($path);
    })->where('file' , '.+');
}
