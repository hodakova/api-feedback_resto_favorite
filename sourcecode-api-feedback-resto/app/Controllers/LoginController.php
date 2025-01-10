<?php
namespace App\Controllers;
use App\Models\LoginModel;

class LoginController extends BaseController {
    public function index(){
        return view('login');
    }

    public function login_action(){
        $model = model(LoginModel::class);
        $email = $this->request->getPost('email');
        $password = hash('sha256', $this->request->getPost('password'));
        $cek = $model->getDataUsers($email, $password);
        if ($cek){
            session()->set('num_user', $cek->id);
            session()->set('name', $cek->name);
            session()->set('role', $cek->role);
            return redirect()->to('/');
        } else {
            return redirect()->to('/login');
        }
    }
    
    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}