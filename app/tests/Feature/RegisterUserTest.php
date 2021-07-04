<?php


namespace Tests\Feature;


use App\Enum\ApiRouteEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterUserTest extends ApiTest
{
    use RefreshDatabase;

    protected string $uri = ApiRouteEnum::REGISTER_USER_ROUTE;

    protected array $allowedMethods = [Request::METHOD_POST];

    public function test_not_allowed_method()
    {
        $this->checkNotAllowedMethod();
    }

    public function test_invalid_body()
    {
        $response = $this->post(
            $this->uri,
            [
                'name' => 'name',
            ]
        );
        $this->assertInvalidBody($response);

        $response = $this->post(
            $this->uri,
            [
                'email' => 'mailname@email.com',
            ]
        );
        $this->assertInvalidBody($response);

        $response = $this->post(
            $this->uri,
            [
                'password' => 'password'
            ]
        );
        $this->assertInvalidBody($response);

        $response = $this->post(
            $this->uri,
            [
                'name' => 'name',
                'email' => 'email.com',
                'password' => 'password',
            ]
        );
        $this->assertInvalidBody($response);
    }

    public function test_valid_and_correct_body()
    {
        $response = $this->json(
            Request::METHOD_POST,
            $this->uri,
            [
                'name' => 'name',
                'email' => 'test@email.com',
                'password' => 'password',
            ]
        );
        $user = User::all()->where('email', '=', 'test@email.com')->first();

        $this->assertNotNull($user);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function assertInvalidBody($response)
    {
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['message', 'errors']);
    }
}
