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
        $usuario=auth()->user()->id;
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
            User::findOrFail($usuario)->update([
                "foto"=>$imagemName,
            ]);
        }
        return redirect("/dashboard");
    }
    public function resumoFinancas()
    {
        /* Necessito arruamr a opção de "no limite" da lista*/
        $usuario=auth()->user();
        $list=Lists::all();
        $listUpOfLimit=Lists::where('valorTotal','>','limiteLista')->where('limiteLista','!=',null)->whereNotIn('finaizada',[1])->where('idCriador',$usuario->id)->get();
        $listInLimit=Lists::where('valorTotal','<=','limiteLista')->where('limiteLista','!=',null)->whereNotIn('finaizada',[1])->where('idCriador',$usuario->id)->get();
        $listOutLimit=Lists::WhereNull('limiteLista')->whereNotIn('finaizada',[1])->where('idCriador',$usuario->id)->get();
        $busca=request('search'); 
        if($busca){
                foreach($list as $li){
                   if($li->created_at->format('m')==$busca){
                        $listUpOfLimit->where('created_at',$busca);
                        $listOutLimit->where('created_at',$busca);
                        $listInLimit->where('created_at',$busca);
                    }else{
                        $listUpOfLimit=null;
                        $listOutLimit=null;
                        $listInLimit=null;
                    } 
                }
            }
        return view('report',['usuario'=>$usuario,'acima'=>$listUpOfLimit,'semlimite'=>$listOutLimit,'nolimite'=>$listInLimit]);

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
        $criador=auth()->user()->id;
        $Criador =user::where('id',$criador)->get('name');
        foreach($Criador as $c){
            $novaLista->Criador=$c->name;
        }
        $novaLista->id=random_int(000000,999999);
        $novaLista->nome = $request->nome;
        $novaLista->categoria = $request->categoria;
        $novaLista->idCriador = $criador;
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
        $user=auth()->user()->id;
        $lista=Lists::findOrFail($idLista);
        $participantes=$lista->users;
        $items=items::where('listaPertence',$idLista)->get();
        return view('list',["user"=>$user,"lista"=>$lista,"items"=>$items,'participantes'=>$participantes]);
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
        if($busca=='now')
        {
            $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[0])->orderBy('created_at','DESC')->get();
            $listasParticipa=$usuario->listAsParticipant;
            $listaParticipa=[];
            foreach ($listasParticipa as $l){
                if($l->finaizada){
                    array_push($listaParticipa,$l);
                }
            }
            arsort($listaParticipa);
           }
        elseif($busca=='old')
        {
            $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[0])->orderBy('created_at','ASC')->get();    
            $listasParticipa=$usuario->listAsParticipant;
            $listaParticipa=[];
            foreach ($listasParticipa as $l){
                if($l->finaizada){
                    array_push($listaParticipa,$l);
                }
            }
            asort($listaParticipa);
        }else{
            $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[0])->where('nome','like','%'.$busca.'%')->get();
            $listasParticipa=$usuario->listAsParticipant;
            $listaParticipa=[];
            foreach ($listasParticipa as $l){
                if($l->finaizada){
                    array_push($listaParticipa,$l);
                }
            }
        }
     return view('historic',['suasListas'=>$suasListas,'listasParticipa'=>$listaParticipa]);
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
    public function participarLista(Request $request){
        $id=$request->id;
        $list=Lists::where('id',$id)->first();
        if(!isset($list)){
            return back()->with('danger','Lista não encontrada, tente outro convite');
        }
        $user=auth()->user();
        if($user->id!=$list->idCriador){
            $user->listAsParticipant()->attach($id);
            $user->update([
                'lParticipando'=>$user->lParticipando+1,
            ]);
            return redirect('/index');
        }elseif($list->finalizado){
            return back()->with('danger','Lista não encontrada, tente outro convite');
        }else{
            return back()->with('danger','Você é o criar desta lista');
        }
    }
    public function removerParticipacao(Request $request){
        $id=$request->id;
        $list=Lists::findOrFail($id);
        $user=user::findOrFail($request->idUsuario);
        $user->listAsParticipant()->detach($id);
        $user->update([
            'lParticipando'=>$user->lParticipando-1,
        ]);
        return redirect('/list/'.$id);
    }
}
