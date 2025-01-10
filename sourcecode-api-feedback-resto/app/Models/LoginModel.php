<?php
namespace App\Models;
use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'users';
    protected $returnType = 'object';

    public function getDataUsers($email, $password)
    {
        return $this->where('email', $email)
                    ->where('password', $password)
                    ->first();
    }
}
