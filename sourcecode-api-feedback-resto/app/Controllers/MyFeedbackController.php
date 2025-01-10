<?php

namespace App\Controllers;

use App\Models\MyFeedbackModel;
use CodeIgniter\Controller;

class MyFeedbackController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new MyFeedbackModel();
    }

    public function index()
    {
        $userId = session()->get('num_user');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please log in to view your feedback.');
        }

        $feedbacks = $this->model->getFeedbacksByUser($userId);

        $data = [
            'feedbacks' => $feedbacks,
        ];

        return view('head').view('menu').view('my_feedback', $data).view('footer');
    }
}
