<?php

// App/Filters/JwtAuthFilter.php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Config\Services;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JwtAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');
        if (!$header) {
            return Services::response()->setJSON(['message' => 'No Authorization header'])->setStatusCode(401);
        }

        $token = explode(' ', $header)[1];

        try {
            $key = getenv('JWT_SEGURA');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return Services::response()->setJSON(['message' => 'Invalid token: ' . $e->getMessage()])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
