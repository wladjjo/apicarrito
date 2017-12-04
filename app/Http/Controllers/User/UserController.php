<?php

 
use App\User;
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *///lista de los recursos disponibles
    public function index()
    {
        $usuarios = User::all();

        return $this->showAll($usuarios);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
                'name' =>'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8'    
        ];
        $this->validate($request, $reglas);
        $campos-> $request->all();
        $campos = $request ->all();//array con los datos
        $campos['password']= bcrypt($request->password);
        $campos['verified']=User::USUARIO_NO_VERIFICADO;
        $campos['verification_token']=User::generarVerificationToken();
        $campos['admin']= User::USUARIO_REGULAR;
        $usuario = User::create($campos);
        return $this->showOne($usuario, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       
        return $this->showOne($user);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   
        
        $rules = [
                'email' => 'email|unique:users,email,'. $user->id,
                'password' => 'min:8',
                'admin' => 'in'. User::USUARIO_ADMINISTRADOR . ','. User::USUARIO_REGULAR,  
        ];
        $this ->validate($request, $reglas);
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email') && $user->mail != $request->email) {
            $user->verified = User::USUARIO_VERIFICADO;
            $user->verification_token = User::generarVerificationToken();
            $user->email = $request-$user->email;
        }
        if ($request-$user->has('email') && $user->email != $request->email) {
            $user->verified = User::USUARIO_VERIFICADO;
            $user->verification_token = User::generarVerificationToken();
            $user->email = $request-$user->email;
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        if ($request->has('admin')) {
            if(!$user->esVerificado()){
               return $this->errorResponse('Comuniquese con el adminitrados del sitio para esta solicitud',  409); 
            }
            $user->admin = $request->admin;
        }
        if (!$user->isDirty()) {
            return $this->errorResponse('Debe tener algun valor distinto', 422);
        }
        $user->save();
        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       
       $user ->delete();
      return $this->showOne($user); 
    }
}
