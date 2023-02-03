<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lists;
use App\Models\items;
use Illuminate\Http\Request;


class listsController extends Controller
{
    public function perfil()
    {
        $usuario=auth()->user();
        $suasListasFinalizadas=count(Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[0])->get());
        $suasListas=count(Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[1])->get());
        return view('profile',['usuario'=>$usuario,'lAbertas'=>$suasListas,'lFinalizadas'=>$suasListasFinalizadas]);
    }
    public function adicionarFotoPerfil(Request $request)
    {
        dd('here');
        /*$usuario=auth()->user()->id;
        $atualizadoUsuario;
        if($request->hasfile('foto') && $request->file('foto')->isValid()){
            //Pega a imagem
            $requestImagem=$request->foto;
            //pega a extensão
            $extension=$requestImagem->extension();
            //cria o nome da imagem
            $imagemName=md5($requestImagem->getClientOriginalName().strtotime("now")).".".$extension;
            //move para a pasta das imagens
            $requestImagem->move(public_path(),$imagemName);
            //salva no bd
            $atualizadoUsuario=$imagemName;
           }
    
        User::findOrFail($usuario)->uddate([
            'foto'->$atualizadoUsuario,
        ]);
        return back();*/
    }
    public function resumoFinancas()
    {
        $usuario=auth()->user();
        $suasListasFinalizadas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[0])->get();
        $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[1])->get();
        return view('report',['usuario'=>$usuario,'lAbertas'=>$suasListas,'lFinalizadas'=>$suasListasFinalizadas]);
    }
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
        $novaLista->Criador = user::findOrFail(auth()->user()->id)->get('name');
        foreach($novaLista->Criador as $criador){
            $novaLista->Criador=$criador->name;
        }
        $novaLista->codListParticipante=random_int(000000,999999);
        $novaLista->valorTotal = 0;
        $novaLista->quantidadeItem = 0;
        $novaLista->finaizada = 0;
        $novaLista->porcetagemLimite= 0;
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
        if(isset($listaCerta->limiteLista))
        {
            $porcentagem=($valor/$listaCerta->limiteLista)*100;
            $listaCerta->update([
                'valorTotal'=>$valor,
                'porcetagemLimite'=>$porcentagem,
                'quantidadeItem'=>$novaQuantidade,
            ]);
         
        }else
        {
            $listaCerta->update([
                'valorTotal'=>$valor,
                'quantidadeItem'=>$novaQuantidade,
            ]);
        }
        return redirect('/list/'.$request->idLista.'');
    }
    public function finalizarLista()
    {
        Lists::findOrFail($_GET['id'])->update([
            'finaizada'=>1,
        ]);
        return redirect('/index');
    }
    public function listasFinalizadas(Request $request)
    {
        $usuario=auth()->user();
        $busca=$request['pesquisa'];
        if(isset($busca))
        {
            if($busca=='now')
            {
                $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[0])->orderBy('created_at','DESC')->get();
            }
            elseif($busca=='old')
            {
                $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[0])->orderBy('created_at','ASC')->get();    
            }else{
                $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[0])->where('nome','like','%'.$busca.'%')->get();
            }
        }
        else
        {
            $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[0])->get();
        }
               return view('historic',['suasListas'=>$suasListas]);
    }
    public function destruirItem()
    {
        $itemRemover=items::findOrFail($_GET['id_item']);
        $listaCerta=Lists::findOrFail($_GET['id_lista']);
        $novaQuantidade=($listaCerta->quantidadeItem)-1;
        $valor=($listaCerta->valorTotal)-($itemRemover->quantidade*$itemRemover->preco);
        if(isset($listaCerta->limiteLista))
        {
            $porcentagem=($valor/$listaCerta->limiteLista)*100;
            $listaCerta->update([
                'valorTotal'=>$valor,
                'porcetagemLimite'=>$porcentagem,
                'quantidadeItem'=>$novaQuantidade,
            ]);
         
        }else
        {
            $listaCerta->update([
                'valorTotal'=>$valor,
                'quantidadeItem'=>$novaQuantidade,
            ]);
            }
        $itemRemover->delete();
        return back();
    }
    public function quantidadeItem()
    {
        $item=items::findOrFail($_GET['id_item']);
        $listaCerta=Lists::findOrFail($_GET['id_lista']);
        if($_GET['sinal']=='!')
        {
            $valorFinal=($listaCerta->valorTotal+$item->preco);
            $item->update(['quantidade'=>$item->quantidade+1,]);
        }
        elseif($_GET['sinal']=='-')
        {
            $valorFinal=($listaCerta->valorTotal-$item->preco);
            if($item->quantidade>1){
                $item->update(['quantidade'=>$item->quantidade-1,]);
            }else{
                $novaQuantidade=($listaCerta->quantidadeItem)-1;
                $valor=($listaCerta->valorTotal)-($item->quantidade*$item->preco);
                if(isset($listaCerta->limiteLista))
                {
                    $porcentagem=($valor/$listaCerta->limiteLista)*100;
                    $listaCerta->update([
                        'valorTotal'=>$valor,
                        'porcetagemLimite'=>$porcentagem,
                        'quantidadeItem'=>$novaQuantidade,
                    ]);
                 
                }else
                {
                    $listaCerta->update([
                        'valorTotal'=>$valor,
                        'quantidadeItem'=>$novaQuantidade,
                    ]);
                    }
                $item->delete();
            }
        }
        if(isset($listaCerta->limiteLista))
        {
            $porcentagem=($valorFinal/$listaCerta->limiteLista)*100;
            $listaCerta->update([
                'valorTotal'=>$valorFinal,
                'porcetagemLimite'=>$porcentagem,
             ]);
         
        }else
        {
            $listaCerta->update([
                'valorTotal'=>$valorFinal,
             ]);
        }
         return back();
    }

}
