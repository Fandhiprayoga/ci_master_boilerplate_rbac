<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Entities\User;

/**
 * Role Filter - Memeriksa apakah user memiliki role/group yang sesuai
 *
 * Usage di routes:
 *   $routes->get('admin', 'Admin::index', ['filter' => 'role:superadmin,admin']);
 */
class RoleFilter implements FilterInterface
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

        // Cek apakah user memiliki salah satu role yang diizinkan
        foreach ($arguments as $group) {
            if ($user->inGroup($group)) {
                return;
            }
        }

        // Jika tidak memiliki role yang sesuai
        return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
