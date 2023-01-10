<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lists;
use App\Models\items;


class listsController extends Controller
{
    public function criarLista()
    {
        return view('new_list');
    }
    public function criarListaForms(Request $request)
    {        
       $this->validate($request,[
        'nome'=>'required',
        'categoria'=>'required'
        ],[
            'required' => 'Os campos marcados com * são obrigartorios!',
        ]);
        $novaLista = new Lists;
        $novaLista->nome = $request->nome;
        $novaLista->categoria = $request->categoria;
        $novaLista->idCriador = auth()->user()->id;
        $novaLista->valorTotal = 0;
        $novaLista->quantidadeItem = 0;
        $novaLista->finaizada = 0;
        $novaLista->limiteLista = $request->limiteLista;
        $novaLista->save();
        return redirect('/index');
    }
    public function Lista($idLista)
    {
        $lista=Lists::findOrFail($idLista);
        $items=items::where('listaPertence',$idLista)->get();
        return view('list',["lista"=>$lista,"items"=>$items]);
    }
    public function criarItemsForms(Request $request)
    {
        $novoItem = new items;
        $novoItem->nomeProduto = $request->nome;
        $novoItem->preco = $request->preco;
        $novoItem->quantidade = $request->quantidade;
        $novoItem->descricao = $request->descricao;
        $novoItem->responsavelItem = auth()->user()->id;
        $novoItem->listaPertence = $request->idLista;
        $novoItem->save();
        $listaCerta=Lists::findOrFail($novoItem->listaPertence);
        $novaQuantidade=($listaCerta->quantidadeItem)+1;
        $valor=($listaCerta->valorTotal)+($novoItem->quantidade*$novoItem->preco);
        $listaCerta->update([
            'valorTotal'=>$valor,
            'quantidadeItem'=>$novaQuantidade,
        ]);
        return redirect('/list/'.$request->idLista.'');
    }
    public function finalizarLista()
    {
        Lists::findOrFail($_GET['id'])->update([
            'finaizada'=>1,
        ]);
        return redirect('/index');
    }
    public function listasFinalizadas()
    {
        $usuario=auth()->user();
        $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[0])->get();
        return view('historic',['suasListas'=>$suasListas]);
    }

}
