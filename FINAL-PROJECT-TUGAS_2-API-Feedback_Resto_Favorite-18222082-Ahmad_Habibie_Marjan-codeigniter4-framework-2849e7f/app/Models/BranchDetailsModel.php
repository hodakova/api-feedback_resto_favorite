<?php

namespace App\Models;

use CodeIgniter\Model;

class BranchDetailsModel extends Model
{
    protected $table = 'branches';
    protected $primaryKey = 'id';

    public function getBranchesWithDetails()
    {
        return $this->select('branches.id as branch_id, branches.name as branch_name, branches.location, menu_items.id as menu_id, menu_items.name as menu_name, menu_items.price, feedbacks.id as feedback_id, feedbacks.comment, feedbacks.rating, feedbacks.menu_item_id, users.name as user_name')
                    ->join('menu_items', 'menu_items.branch_id = branches.id', 'left')
                    ->join('feedbacks', 'feedbacks.branch_id = branches.id', 'left')
                    ->join('users', 'feedbacks.user_id = users.id', 'left')
                    ->orderBy('branches.id, menu_items.id, feedbacks.id')
                    ->findAll();
    }
}
