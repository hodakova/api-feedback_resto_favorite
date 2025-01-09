<?php

namespace App\Controllers;

use App\Models\BranchModel;
use CodeIgniter\RESTful\ResourceController;

class BranchController extends ResourceController {
    protected $modelName = 'App\Models\BranchModel';
    protected $format    = 'json';

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->validate([
            'name'         => 'required|string',
            'location'     => 'required|string',
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'Cabang berhasil ditambahkan']);
        }

        return $this->fail('Gagal menambahkan cabang');
    }



    public function index()
    {
        $branches = $this->model->findAll();
        
        if (empty($branches)) {
            return $this->failNotFound('Tidak ada cabang ditemukan');
        }

        return $this->respond($branches);
    }



    public function show($id = null)
    {
        $branch = $this->model->select('branches.*')
        ->where('branches.id', $id)
        ->first();
    
        if (!$branch) {
            return $this->failNotFound('Cabang tidak ditemukan');
        }

        return $this->respond($branch);
    }

    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            $this->model->delete($id);
            return $this->respondDeleted(['message' => 'Cabang berhasil dihapus']);
        }

        return $this->failNotFound('Cabang tidak ditemukan');
    }
}
