<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->validate([
            'name'         => 'required|string',
            'email'        => 'required|string',
            'password'     => 'required|string',
            'role'         => 'required|in_list[customer,admin]'
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data['password'] = hash('sha256', $data['password']);
        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'User berhasil ditambahkan']);
        }

        return $this->fail('Gagal menambahkan user');
    }

    

    public function index()
    {
        $users = $this->model->findAll();

        if (empty($users)) {
            return $this->failNotFound('Tidak ada user ditemukan');
        }

        return $this->respond($users);
    }

    public function show($id = null)
    {
        $user = $this->model->select('users.*')
            ->where('users.id', $id)
            ->first();

        if (!$user) {
            return $this->failNotFound('User tidak ditemukan');
        }

        return $this->respond($user);
    }

    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            $this->model->delete($id);
            return $this->respondDeleted(['message' => 'User berhasil dihapus']);
        }

        return $this->failNotFound('User tidak ditemukan');
    }
}
