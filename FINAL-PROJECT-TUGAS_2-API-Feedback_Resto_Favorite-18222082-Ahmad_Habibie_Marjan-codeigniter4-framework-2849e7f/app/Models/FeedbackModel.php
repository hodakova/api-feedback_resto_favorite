<?php
namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model {
    protected $table = 'feedbacks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['customer_id', 'branch_id', 'menu_item_id', 'rating', 'comment', 'created_at'];
    protected $useTimestamps = false;
}
