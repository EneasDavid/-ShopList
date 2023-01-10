<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\listsController;
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

Route::get('/', [Controller::class, 'login'])->name('login');
Route::post('/Forms-Login',[Controller::class, 'loginForms'])->name('login.forms');
Route::post('/Forms-Cadastro',[Controller::class, 'cadastroForms'])->name('login.cadastro');

Route::get('/password_reset', [Controller::class, 'indexSenha']);
Route::post('/esqueceuSenha-Forms-email', [Controller::class, 'esqueceuSenhaFormsEmail'])->name('recSenhaToEmail');
Route::PUT('/esqueceuSenha-Forms', [Controller::class, 'esqueceuSenhaForms'])->name('recSenhaEntidade');


Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
})->middleware('auth')->name('logout');

Route::get('/index', [Controller::class, 'index'])->middleware('auth');

Route::get('/new_list', [listsController::class, 'criarLista'])->middleware('auth');
Route::POST('/creat_list', [listsController::class, 'criarListaForms'])->middleware('auth')->name('criarLista');
Route::get('/list/{id}', [listsController::class, 'Lista'])->middleware('auth');
Route::POST('/adicionarItem', [listsController::class, 'criarItemsForms'])->middleware('auth')->name('dicionarItem');
Route::get('/finalizarLista', [listsController::class, 'finalizarLista'])->middleware('auth');

Route::get('/historic', [listsController::class, 'listasFinalizadas'])->middleware('auth');

Route::get('/report', function () {
    return view('report');
});

Route::get('/settings', function () {
    return view('settings');
});

Route::get('/donation', function () {
    return view('donation');
});

Route::get('/profile', function (){
    return view('profile');
});

