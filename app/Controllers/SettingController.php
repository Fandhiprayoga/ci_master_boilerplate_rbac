<?php

namespace App\Controllers;

class SettingController extends BaseController
{
    public function index()
    {
        $data = [
            'title'      => 'Pengaturan',
            'page_title' => 'Pengaturan Sistem',
        ];

        return $this->renderView('settings/index', $data);
    }

    public function update()
    {
        // Implementasi update settings
        return redirect()->to('/admin/settings')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
