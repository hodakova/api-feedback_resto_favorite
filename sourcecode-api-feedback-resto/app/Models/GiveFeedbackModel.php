<?php

namespace App\Models;

use CodeIgniter\Model;

class GiveFeedbackModel extends Model
{
    protected $table = 'feedbacks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'branch_id', 'menu_item_id', 'rating', 'comment', 'created_at'];

    public function getBranches()
    {
        return $this->db->table('branches')
            ->select('id, name')
            ->get()
            ->getResultArray();
    }

    public function getMenuItemsByBranch($branchId)
    {
        return $this->db->table('menu_items')
            ->select('id, name')
            ->where('branch_id', $branchId)
            ->get()
            ->getResultArray();
    }
}
