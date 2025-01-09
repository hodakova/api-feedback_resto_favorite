<?php

namespace App\Controllers;

use App\Models\FeedbackModel;
use CodeIgniter\RESTful\ResourceController;

class FeedbackController extends ResourceController
{
    protected $modelName = 'App\Models\FeedbackModel';
    protected $format    = 'json';

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->validate([
            'user_id'  => 'required|integer|is_not_unique[users.id]',
            'branch_id'    => 'required|integer|is_not_unique[branches.id]',
            'menu_item_id' => 'permit_empty|integer|is_not_unique[menu_items.id]',
            'rating'       => 'required|integer|greater_than[0]|less_than_equal_to[5]',
            'comment'      => 'permit_empty|string',
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'Feedback berhasil ditambahkan']);
        }

        return $this->fail('Gagal menambahkan feedback');
    }

    

    public function index()
    {
        $feedbacks = $this->model->findAll();

        if (empty($feedbacks)) {
            return $this->failNotFound('Tidak ada feedback ditemukan');
        }

        return $this->respond($feedbacks);
    }

    public function show($id = null)
    {
        $feedback = $this->model->select(
            'feedbacks.*, 
             users.name AS user_name, 
             branches.name AS branch_name, 
             menu_items.name AS menu_name'
        )
            ->join('users', 'feedbacks.user_id = users.id')
            ->join('branches', 'feedbacks.branch_id = branches.id')
            ->join('menu_items', 'feedbacks.menu_item_id = menu_items.id', 'left')
            ->where('feedbacks.id', $id)
            ->first();

        if (!$feedback) {
            return $this->failNotFound('Feedback tidak ditemukan');
        }

        return $this->respond($feedback);
    }

    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            $this->model->delete($id);
            return $this->respondDeleted(['message' => 'Feedback berhasil dihapus']);
        }

        return $this->failNotFound('Feedback tidak ditemukan');
    }
}
