<?php
namespace App\Models;

use CodeIgniter\Model;

class MenuItemModel extends Model {
    protected $table = 'menu_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'price', 'branch_id'];
    protected $useTimestamps = false;
}
