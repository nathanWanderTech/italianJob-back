<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginTest extends ApiTest
{
    use RefreshDatabase;

    protected string $uri = "/api/auth/login";

    protected array $allowedMethods = [Request::METHOD_POST];

    public function test_not_allowed_method()
    {
        $this->checkNotAllowedMethod();
    }

    public function test_valid_and_correct_body()
    {
        User::factory()->createOne([
            'email' => 'test@email.com'
        ]);

        $response = $this->json(
            Request::METHOD_POST,
            $this->uri,
            [
                'email' => 'test@email.com',
                'password' => 'password',
            ]
        );

        $response->assertOk()
            ->assertJsonStructure(
                ['access_token', 'token_type', 'expires_in']
            );
    }

    public function test_invalid_body()
    {
        $response = $this->post($this->uri, [
            'email' => 'test@email.com',
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response = $this->post($this->uri, [
            'email' => 'testemail.com',
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response = $this->post($this->uri, [
            'password' => 'password'
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response = $this->post($this->uri, []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_incorrect_body()
    {
        $response = $this->json(
            Request::METHOD_POST,
            $this->uri,
            [
                'email' => 'notexisted@email.com',
                'password' => 'notexisted',
            ]
        );
        $response->assertUnauthorized();
    }
}
