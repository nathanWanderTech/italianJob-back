<?php


namespace Tests\Feature;


use App\Enum\ApiRouteEnum;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Request;

class ForgotPasswordTest extends ApiTest
{
    protected string $uri = ApiRouteEnum::FORGOT_PASSWORD_ROUTE;

    protected array $allowedMethods = [Request::METHOD_GET];

    public function test_not_allowed_method()
    {
        $this->checkNotAllowedMethod();
    }

    public function test_send_mail_to_reset_password()
    {
        Mail::fake();
    }
}
