<?php

namespace App\Models;

use CodeIgniter\Model;

class MyFeedbackModel extends Model
{
    protected $table = 'feedbacks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'branch_id', 'menu_item_id', 'rating', 'comment', 'created_at'];

    /**
     * Get feedbacks by user ID.
     */
    public function getFeedbacksByUser($userId)
    {
        return $this->select('feedbacks.*, branches.name as branch_name, menu_items.name as menu_item_name, menu_items.price as menu_price')
            ->join('branches', 'feedbacks.branch_id = branches.id', 'left')
            ->join('menu_items', 'feedbacks.menu_item_id = menu_items.id', 'left')
            ->where('feedbacks.user_id', $userId)
            ->orderBy('feedbacks.created_at', 'DESC')
            ->findAll();
    }
}
