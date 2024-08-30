<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{

  public function index()
  {
    return view('login');
  }

  public function login()
  {
    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');

    $model = new UserModel;

    $data = $model->where(['username'=>$username,'password'=>md5($password)])->first();

    if($data){
      $ses_data = [
        'id'        => $data->id,
        'username'  => $data->username,
        'nama'      => $data->nama,
        'role'      => $data->role,
        'isLoggedIn'=> TRUE
      ];
      session()->set($ses_data);
      return redirect()->to('dashboard');
    }else{
      // return redirect()->back()->with('message', 'Username/Password tidak sesuai');
    }
  }

  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to($_ENV['SSO_SIGNIN'].'?appid='.$_ENV['SSO_APPID']);
  }
}
