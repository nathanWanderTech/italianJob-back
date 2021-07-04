<?php


namespace Tests\Feature;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ApiTest extends TestCase
{
    protected array $requestMethods = [
        Request::METHOD_PUT,
        Request::METHOD_GET,
        Request::METHOD_POST,
        Request::METHOD_DELETE,
        Request::METHOD_PATCH,
    ];

    protected string $uri = '';

    protected array $allowedMethods = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Content-type' => 'application/json',
            'Accept' => 'application/json',
        ]);
    }

    public function checkNotAllowedMethod()
    {
        foreach ($this->requestMethods as $requestMethod) {
            if (in_array($requestMethod, $this->allowedMethods)) {
                continue;
            }
            $response = $this->json($requestMethod, $this->uri);
            $response->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }
}
