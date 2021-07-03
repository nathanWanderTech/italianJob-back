<?php

namespace Tests\Feature;

use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class LogoutTest extends ApiTest
{
    protected string $uri = "/api/auth/logout";

    protected array $allowedMethods = [Request::METHOD_POST];

    public function test_not_allowed_method()
    {
        $this->checkNotAllowedMethod();
    }

    public function test_not_have_authorization_header()
    {
        $response = $this->post($this->uri);
        $response->assertUnauthorized();
    }

    public function test_have_authorization_header()
    {
        User::factory()->createOne([
            'email' => 'test@email.com'
        ]);

        $response = $this->json(
            Request::METHOD_POST,
            '/api/auth/login',
            [
                'email' => 'test@email.com',
                'password' => 'password',
            ]
        );
        $tokenAccess = $response->getOriginalContent()['access_token'];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $tokenAccess,
        ]);

        $response = $this->json(Request::METHOD_POST, $this->uri);
        $response->assertOk();
    }
}
