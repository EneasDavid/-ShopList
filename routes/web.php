<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\listsController;
use App\Mail;
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
Route::get('/donation', function () {
    return view('donation');
});

Route::middleware('guest')->group(function(){
    Route::get('/', [Controller::class, 'login'])->name('login');
    Route::POST('/Forms-Login',[Controller::class, 'loginForms'])->name('login.forms');
    Route::POST('/Forms-Cadastro',[Controller::class, 'cadastroForms'])->name('login.cadastro');
    
    Route::get('/password_reset', [Controller::class, 'indexSenha']);
    Route::POST('/esqueceuSenha-Forms-email', [Controller::class, 'esqueceuSenhaFormsEmail'])->name('recSenhaToEmail');
    Route::get('/esqueceuSenha-Forms-senha/{userId}', [Controller::class, 'verificaIDPassword']);
    Route::POST('/esqueceuSenha-Forms', [Controller::class, 'esqueceuSenhaForms'])->name('recSenhaEntidade');
});
Route::middleware('auth')->group( function(){
    Route::get('/logout',function(){
        Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::get('/dashboard', [listsController::class, 'perfil']);
    Route::get('/home', [Controller::class, 'index']);
    Route::get('/report', [listsController::class, 'resumoFinancas']);
    Route::POST('/adicionarFotoPerfil', [listsController::class, 'adicionarFotoPerfil'])->name('adicionarFotoPerfil');

    Route::get('/new_list', [listsController::class, 'criarLista']);
    Route::POST('/creat_list', [listsController::class, 'criarListaForms'])->name('criarLista');
    Route::get('/list/{id}', [listsController::class, 'Lista']);
    Route::get('/listChange/{id}', [listsController::class, 'ListaMudanca']);
    Route::POST('/listItemChange', [listsController::class, 'listaItemMudanca']);
    Route::POST('/adicionarItem', [listsController::class, 'criarItemsForms'])->name('dicionarItem');
    Route::get('/finalizarLista', [listsController::class, 'finalizarLista']);

    Route::delete('/deleteItem', [listsController::class, 'destruirItem'])->name('deleteItem');
    Route::get('/historic', [listsController::class, 'listasFinalizadas']);

    Route::get('/editList/{id}', [listsController::class, 'editarLista']);
    Route::post('/editarLista', [listsController::class, 'editarListaForms']);

    Route::get('/quantidadeItem', [listsController::class, 'quantidadeItem']);

    Route::POST('/participaAsList', [listsController::class, 'participarLista'])->name('participaAsList');
    Route::delete('/removerParticipacao', [listsController::class, 'removerParticipacao'])->name('removerParticipacao');
});



