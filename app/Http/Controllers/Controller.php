<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Lists;
use Illuminate\Support\Facades\Mail;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //Before Login
        public function cadastroForms(Request $request)
        {
            $novoUsuario = new User;
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'password'=>'required',
            ],[
                'name.required'=>'Os campos marcados com * são obrigatorios',
                'email.required'=>'Os campos marcados com * são obrigatorios',
                'password.required'=>'Os campos marcados com * são obrigatorios',
            ]);
            $novoUsuario->name = $request->name;
            if(!empty(user::where('email',$request->email)->first())){
            return redirect()->back()->with('danger','E-mail já cadastrado!');
            }
            $novoUsuario->email = $request->email;
            $novoUsuario->lParticipando=0;
            $novoUsuario->password = Hash::make($request->password);
            $novoUsuario->save();    
            return redirect('/')->with('msg','Cadastro realizado com sucesso!');
        }
    //Login
        public function login()
        {
            if(auth()->user()){
                return back();
            }
            return view('signup');
        }
        public function loginForms(Request $request)
        {
            $this->validate($request,[
                'email'=>'required',
                'password'=>'required'
            ],[
                //'required' => 'A :attribute é um campo obrigartorio!',
                'email.required'=>'O campo Email é obrigatorio',
                'password.required'=>'O campo Senha é obrigatorio',
                
            ]);
            $usuario=User::where('email',$request->email)->first(); 
            if($usuario && Hash::check($request->password,$usuario->password)){
                Auth::loginUsingId($usuario->id);
                return redirect('/home');
            }else{
                return redirect()->back()->with('danger','E-mail ou senha invalida!');
            }
        }
    
    //middle login
        public function indexSenha()
        {
            return view('password_reset');            
        }
        public function esqueceuSenhaFormsEmail(Request $request)
        {
            $this->validate($request,[
                'email'=>'required',
            ],[
                'required' => 'O compo de :attribute é um campo obrigartorio!',  
            ]);
            $usuario=User::where('email',$request->email)->first(); 
            if(!$usuario){
                return back()->with('danger','Email não cadastrado, tente outro!');
            }
            //return new \App\Mail\SendMail($usuario);
            Mail::send(new \App\Mail\SendMail($usuario));
            return redirect('/password_reset')->with('success','Enviamos um email com as instruções para redefinir sua senha');
        }
        public function verificaIDPassword($id) 
        {
            $user=user::all();
            foreach($user as $destinatario){
                if(Hash::check($destinatario->id,$id)){
                    return view('password_resetPassword',['entidade'=>$destinatario]);
                }
            }
            return back()->with('danger','usuario não encontrado');
           }

        public function esqueceuSenhaForms (Request $request) 
        {
            user::findOrFail($request->id)->update([
                'password'=>Hash::make($request->senha),
            ]);     
            return redirect('/')->with('success','Senha alterada com sucesso');
        }
    //after login
        public function index(Request $request)
        {
            $usuario=auth()->user();
            $busca=$request['pesquisa'];
            if(isset($busca))
            {
                if($busca=='now')
                {
                    $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[1])->orderBy('created_at','DESC')->get();
                    $listasParticipa=$usuario->listAsParticipant;
                    $listaParticipa=[];
                    foreach ($listasParticipa as $l){
                        if($l->finaizada==0){
                            array_push($listaParticipa,$l);
                        }
                    }
                    arsort($listaParticipa);
                   }
                elseif($busca=='old')
                {
                    $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[1])->orderBy('created_at','ASC')->get();    
                    $listasParticipa=$usuario->listAsParticipant;
                    $listaParticipa=[];
                    foreach ($listasParticipa as $l){
                        if($l->finaizada==0){
                            array_push($listaParticipa,$l);
                        }
                    }
                    asort($listaParticipa);
                    }else{
                    $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[1])->where('nome','like','%'.$busca.'%')->get();
                    $listasParticipa=$usuario->listAsParticipant;
                    $listaParticipa=[];
                    foreach ($listasParticipa as $l){
                        if($l->finaizada==0){
                            array_push($listaParticipa,$l);
                        }
                    }

                }
            }
            else
            {
                $suasListas=Lists::where('idCriador',$usuario->id)->whereNotIn('finaizada',[1])->get();
                $listasParticipa=$usuario->listAsParticipant;
                $listaParticipa=[];
                foreach ($listasParticipa as $l){
                    if($l->finaizada==0){
                        array_push($listaParticipa,$l);
                    }
                }
            }
            return view('home',['suasListas'=>$suasListas,'listasParticipa'=>$listaParticipa]);
        }
}
