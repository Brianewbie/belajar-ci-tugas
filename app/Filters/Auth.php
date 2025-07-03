<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to(site_url('login'));
        }

        // Tambahan: cek role jika ada argument role
        if ($arguments && in_array('admin', $arguments)) {
            if (session()->get('role') !== 'admin') {
                return redirect()->to(site_url('/'))->with('error', 'Akses hanya untuk admin');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Optional: Do something after
    }
}
