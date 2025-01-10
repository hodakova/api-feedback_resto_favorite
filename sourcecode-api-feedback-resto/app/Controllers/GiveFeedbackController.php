<?php

namespace App\Controllers;

use App\Models\GiveFeedbackModel;
use CodeIgniter\Controller;

class GiveFeedbackController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new GiveFeedbackModel();
    }

    public function index()
    {
        $branches = $this->model->getBranches();

        $data = [
            'branches' => $branches,
            'menuItems' => [],
        ];

        return view('head').view('menu').view('give_feedback', $data).view('footer');
    }

    public function getMenuItems($branchId)
    {
        $menuItems = $this->model->getMenuItemsByBranch($branchId);

        return $this->response->setJSON($menuItems);
    }

    public function submitFeedback()
    {
        $userId = session()->get('num_user');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Login terlebih dahulu.');
        }

        $data = $this->request->getPost();

        $data['user_id'] = $userId;

        if (!$this->validate([
            'branch_id' => 'required|integer|is_not_unique[branches.id]',
            'menu_item_id' => 'permit_empty|integer|is_not_unique[menu_items.id]',
            'rating' => 'required|integer|greater_than[0]|less_than_equal_to[5]',
            'comment' => 'permit_empty|string',
        ])) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        if ($this->model->insert($data)) {
            return redirect()->to('/give_feedback')->with('success', 'Feedback berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan feedback. Silakan coba lagi.')->withInput();
    }
}
