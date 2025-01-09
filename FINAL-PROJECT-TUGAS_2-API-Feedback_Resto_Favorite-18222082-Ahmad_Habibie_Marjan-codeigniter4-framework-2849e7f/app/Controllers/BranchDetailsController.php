<?php

namespace App\Controllers;

use App\Models\BranchDetailsModel;
use CodeIgniter\Controller;

class BranchDetailsController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new BranchDetailsModel();
    }

    public function resto_branches()
    {
        $branches = $this->model->getBranchesWithDetails();

        // Strukturkan data berdasarkan branch, menu, dan feedback
        $structuredData = [];
        foreach ($branches as $item) {
            $branchId = $item['branch_id'];
            $menuId = $item['menu_id'];

            // Tambahkan data branch jika belum ada
            if (!isset($structuredData[$branchId])) {
                $structuredData[$branchId] = [
                    'branch' => [
                        'id' => $branchId,
                        'name' => $item['branch_name'],
                        'location' => $item['location'],
                    ],
                    'branch_feedbacks' => [],
                    'menus' => [],
                ];
            }

            // Tambahkan feedback khusus branch
            if (empty($item['menu_item_id']) && !empty($item['comment'])) {
                $structuredData[$branchId]['branch_feedbacks'][] = [
                    'user_name' => $item['user_name'],
                    'rating' => $item['rating'],
                    'comment' => $item['comment'],
                ];
            }

            // Tambahkan menu jika ada
            if (!empty($menuId)) {
                if (!isset($structuredData[$branchId]['menus'][$menuId])) {
                    $structuredData[$branchId]['menus'][$menuId] = [
                        'id' => $menuId,
                        'name' => $item['menu_name'],
                        'price' => $item['price'],
                        'menu_feedbacks' => [],
                    ];
                }

                // Tambahkan feedback khusus menu
                if (!empty($item['menu_item_id']) && $item['menu_item_id'] == $menuId && !empty($item['comment'])) {
                    $structuredData[$branchId]['menus'][$menuId]['menu_feedbacks'][] = [
                        'user_name' => $item['user_name'],
                        'rating' => $item['rating'],
                        'comment' => $item['comment'],
                    ];
                }
            }
        }

        $data = [
            'branches' => $structuredData,
        ];

        return view('head').view('menu').view('resto_branches', $data).view('footer');
    }
}
