<?php

namespace App\Controllers;

use App\Models\MenuItemModel;
use CodeIgniter\RESTful\ResourceController;

class MenuItemController extends ResourceController
{
    protected $modelName = 'App\Models\MenuItemModel';
    protected $format    = 'json';

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->validate([
            'name'         => 'required|string',
            'price'        => 'required|decimal|greater_than[0]',
            'branch_id'    => 'required|integer|is_not_unique[branches.id]',
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'Menu berhasil ditambahkan']);
        }

        return $this->fail('Gagal menambahkan menu');
    }

    

    public function index()
    {
        $menuItems = $this->model->findAll();

        if (empty($menuItems)) {
            return $this->failNotFound('Tidak ada menu ditemukan');
        }

        return $this->respond($menuItems);
    }

    public function show($id = null)
    {
        $menuItem = $this->model->select(
            'menu_items.*, 
             branches.name AS branch_name'
        )
            ->join('branches', 'menu_items.branch_id = branches.id')
            ->where('menu_items.id', $id)
            ->first();

        if (!$menuItem) {
            return $this->failNotFound('Menu tidak ditemukan');
        }

        return $this->respond($menuItem);
    }

    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            $this->model->delete($id);
            return $this->respondDeleted(['message' => 'Menu berhasil dihapus']);
        }

        return $this->failNotFound('Menu tidak ditemukan');
    }
}
