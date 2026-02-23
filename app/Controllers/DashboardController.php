<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $user = auth()->user();

        $data = [
            'title'      => 'Dashboard',
            'page_title' => 'Dashboard',
            'user'       => $user,
            'userGroups' => $user->getGroups(),
        ];

        return $this->renderView('dashboard/index', $data);
    }
}
