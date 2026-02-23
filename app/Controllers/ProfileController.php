<?php

namespace App\Controllers;

class ProfileController extends BaseController
{
    public function index()
    {
        $user = auth()->user();

        $data = [
            'title'      => 'Profil Saya',
            'page_title' => 'Profil',
            'user'       => $user,
            'userGroups' => $user->getGroups(),
        ];

        return $this->renderView('profile/index', $data);
    }

    public function update()
    {
        $user = auth()->user();

        $rules = [
            'username' => 'required|min_length[3]|max_length[30]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user->username = $this->request->getPost('username');

        // Update password jika diisi
        $password = $this->request->getPost('password');
        if (! empty($password)) {
            $user->password = $password;
        }

        $users = auth()->getProvider();
        $users->save($user);

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
