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
        $usuario=auth()->user();
        $listasParticipa=$usuario->listAsParticipant;
        $busca=request('search'); 
        if($busca){
            $list=Lists::where('idCriador',$usuario->id)->whereMonth('created_at', $busca)->get()->toArray();
            $valorTotal=Lists::whereMonth('created_at', $busca)->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
            foreach($listasParticipa as $participacoes){
                if($participacoes->created_at->format('m')==$busca){
                    array_push($list,$participacoes);
                    $vt=['valorTotal'=>$participacoes->valorTotal];
                    array_push($valorTotal,$vt);
                }
            }
        }else{
            $list=Lists::where('idCriador',$usuario->id)->whereMonth('created_at', date('m'))->get()->toArray();
            $valorTotal=Lists::whereMonth('created_at', date('m'))->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
            foreach($listasParticipa as $participacoes){
                if($participacoes->created_at->format('m')==date('m')){
                    array_push($list,$participacoes);
                    $vt=['valorTotal'=>$participacoes->valorTotal];
                    array_push($valorTotal,$vt);
                }
            }
        }
        $valorGastosMes=0;
        $valorGastosJaneiro=0;
        $valorGastosJ=Lists::whereMonth('created_at', '01')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='01'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosJ,$vt);
            }
        }
        $valorGastosFevereiro=0;
        $valorGastosF=Lists::whereMonth('created_at', '02')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='02'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosF,$vt);
            }
        }
        $valorGastosMarco=0;
        $valorGastosM=Lists::whereMonth('created_at', '03')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='03'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosM,$vt);
            }
        }
        $valorGastosAbril=0;
        $valorGastosAb=Lists::whereMonth('created_at', '04')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='04'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosAb,$vt);
            }
        }
        $valorGastosMaio=0;
        $valorGastosMa=Lists::whereMonth('created_at', '05')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='05'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosMa,$vt);
            }
        }
        $valorGastosJunho=0;
        $valorGastosJu=Lists::whereMonth('created_at', '06')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='06'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosJu,$vt);
            }
        }
        $valorGastosJulho=0;
        $valorGastosJl=Lists::whereMonth('created_at', '07')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='07'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosJl,$vt);
            }
        }
        $valorGastosAgosto=0;
        $valorGastosA=Lists::whereMonth('created_at', '08')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='08'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosA,$vt);
            }
        }
        $valorGastosSetembro=0;
        $valorGastosS=Lists::whereMonth('created_at', '09')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='09'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosS,$vt);
            }
        }
        $valorGastosOutubro=0;
        $valorGastosO=Lists::whereMonth('created_at', '10')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='10'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosO,$vt);
            }
        }
        $valorGastosNovembro=0;
        $valorGastosN=Lists::whereMonth('created_at', '11')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='11'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosN,$vt);
            }
        }
        $valorGastosDezembro=0;
        $valorGastosD=Lists::whereMonth('created_at', '12')->where('idCriador',$usuario->id)->get('valorTotal')->toArray();
        foreach($listasParticipa as $participacoes){
            if($participacoes->created_at->format('m')=='12'){
                $vt=['valorTotal'=>$participacoes->valorTotal];
                array_push($valorGastosD,$vt);
            }
        }
        foreach($valorTotal as $li){
            foreach($li as $l){
                $valorGastosMes+=$l;
            }
        }
        foreach($valorGastosJ as $li){
            foreach($li as $l){
                $valorGastosJaneiro+=$l;
            }
        }
        foreach($valorGastosF as $li){
            foreach($li as $l){
                $valorGastosFevereiro+=$l;
         }    
        }    
        foreach($valorGastosM as $li){
            foreach($li as $l){
            $valorGastosMarco+=$l;
         }
        }
        foreach($valorGastosAb as $li){
            foreach($li as $l){
                $valorGastosAbril+=$l;
            }
        }
        foreach($valorGastosMa as $li){
            foreach($li as $l){
                $valorGastosMaio+=$l;
            }
        }
        foreach($valorGastosJu as $li){
                $valorGastosJunho+=$li;
        }
        foreach($valorGastosJl as $li){
            foreach($li as $l){
                $valorGastosJulho+=$l;
            }
        }
        foreach($valorGastosA as $li){
            foreach($li as $l){
                $valorGastosAgosto+=$l;
            }
        }
        foreach($valorGastosS as $li){
            foreach($li as $l){
                $valorGastosSetembro+=$li;
            }
        }
        foreach($valorGastosO as $li){
            foreach($li as $l){
                $valorGastosOutubro+=$l;
            }
        }
        foreach($valorGastosN as $li){
            foreach($li as $l){
                $valorGastosNovembro+=$l;
            }
        }
        foreach($valorGastosD as $li){
            foreach($li as $l){
                $valorGastosDezembro+=$l;
            }
        }
        $valorMaximo=max($valorGastosJaneiro,$valorGastosFevereiro,$valorGastosMarco,$valorGastosAbril,$valorGastosMaio,$valorGastosJunho,$valorGastosJulho,$valorGastosAgosto,$valorGastosSetembro,$valorGastosOutubro,$valorGastosNovembro,$valorGastosDezembro);
        if($valorMaximo==0){
            $valorMaximo=1;
        }
        return view('report',['maximo'=>$valorMaximo,'usuario'=>$usuario, 'listas'=>$list, 'search'=>$busca, 'gastosDoMes'=>$valorGastosMes, 'gastosDoJ'=>$valorGastosJaneiro, 'gastosDoF'=>$valorGastosFevereiro, 'gastosDoM'=>$valorGastosMarco, 'gastosDoAb'=>$valorGastosAbril, 'gastosDoMa'=>$valorGastosMaio, 'gastosDoJu'=>$valorGastosJunho, 'gastosDoJl'=>$valorGastosJulho, 'gastosDoA'=>$valorGastosAgosto, 'gastosDoS'=>$valorGastosSetembro, 'gastosDoO'=>$valorGastosOutubro, 'gastosDoN'=>$valorGastosNovembro, 'gastosDoD'=>$valorGastosDezembro]);
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
        if($request->limiteLista){
            $novaLista->limiteLista =str_replace(",",".",$request->limiteLista);
        }
        $novaLista->save();
        return redirect('/home');
    }
    public function editarLista($id)
    {
        return view('new_list',['lista'=>Lists::findOrFail($id)]);
    }
    public function editarListaForms(Request $request)
    {
        $this->validate($request,[
            'nome'=>'required',
            'categoria'=>'required'
            ],[
                'required' => 'Os campos marcados com * são obrigartorios!',
        ]);
        $listaEdit=Lists::findOrFail($_GET['id']);
        $listaEdit->update([
            'nome'=>$request->nome,
            'categoria'=>$request->categoria,
            'limiteLista'=>$request->limiteLista,
            'porcetagemLimite'=>($listaEdit->valorTotal/str_replace(",",".",$request->limiteLista))*100
        ]);
        return redirect('/list/'.$_GET['id']);
    }
    public function Lista($idLista)
    {
        $user=auth()->user()->id;
        $lista=Lists::findOrFail($idLista);
        $participantes=$lista->users;
        $items=items::where('listaPertence',$idLista)->get();
        return view('list',["user"=>$user,"lista"=>$lista,"items"=>$items,'participantes'=>$participantes]);
    }    
    public function ListaMudanca($idLista)
    {
        $user=auth()->user()->id;
        $lista=Lists::findOrFail($idLista);
        $participantes=$lista->users;
        $itemE=items::findOrFail($_GET['item']);
        $items=items::where('listaPertence',$idLista)->get();
        return view('listChange',['itemE'=>$itemE,"user"=>$user,"lista"=>$lista,"items"=>$items,'participantes'=>$participantes]);
    }
    public function listaItemMudanca(Request $request)
    {
        $itemMudar=items::findOrFail($_GET['item']);
        $listaCerta=Lists::findOrFail($_GET['l']);
        $valor=($listaCerta->valorTotal)-($itemMudar->preco*$itemMudar->quantidade)+($request->quantidade*(str_replace(",",".",$request->preco)));
        $itemMudar->update([
            'nomeProduto'=> $request->nome,
            'preco' => str_replace(",",".",$request->preco),
            'quantidade' => $request->quantidade,
            'descricao' => $request->descricao
        ]);
        if(isset($listaCerta->limiteLista))
        {
            $porcentagem=($valor/$listaCerta->limiteLista)*100;
            $listaCerta->update([
                'valorTotal'=>$valor,
                'porcetagemLimite'=>$porcentagem,
            ]);
        }else
        {
            $listaCerta->update([
                'valorTotal'=>$valor,
            ]);
        }
        return redirect('/list/'.$_GET['l'].'');
    }
    public function criarItemsForms(Request $request)
    {
        $novoItem = new items;
        $novoItem->nomeProduto = $request->nome;
        $novoItem->preco = str_replace(",",".",$request->preco);
        $novoItem->quantidade = $request->quantidade;
        $novoItem->descricao = $request->descricao;
        $novoItem->idResponsavelItem = auth()->user()->id;
        $novoItem->responsavelItem = auth()->user()->name;
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
        return redirect('/home');
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
    public function participarLista(Request $request)
    {
        $id=$request->id;
        $list=Lists::where('id',$id)->first();
        if(!isset($list)){
            return back()->with('danger','Lista não encontrada, tente outro convite');
        }
        $user=auth()->user();
        if($user->id!=$list->idCriador){
            if($list->finaizada){
                return back()->with('danger','Lista não encontrada, tente outro convite');
            }
            $user->listAsParticipant()->attach($id);
            $user->update([
                'lParticipando'=>$user->lParticipando+1,
            ]);
            return redirect('/home');
        }else{
            return back()->with('danger','Você é o criar desta lista');
        }
    }
    public function removerParticipacao(Request $request)
    {
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
