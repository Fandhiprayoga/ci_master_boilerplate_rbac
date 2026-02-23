<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Entities\User;

/**
 * Permission Filter - Memeriksa apakah user memiliki permission tertentu
 *
 * Usage di routes:
 *   $routes->get('users', 'User::index', ['filter' => 'permission:users.list']);
 */
class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Pastikan user sudah login
        if (! auth()->loggedIn()) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (empty($arguments)) {
            return;
        }

        /** @var User $user */
        $user = auth()->user();

        // Cek apakah user memiliki salah satu permission yang dibutuhkan
        foreach ($arguments as $permission) {
            if ($user->can($permission)) {
                return;
            }
        }

        // Jika tidak memiliki permission
        return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
