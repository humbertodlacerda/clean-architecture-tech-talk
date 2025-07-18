<?php

namespace App\Http\Controllers;

use App\Domain\Address\ValueObjects\ZipCode;
use App\Domain\User\Dto\CreateUserDto;
use App\Domain\User\Services\UserService;
use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Password;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\CreatedUserResource;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(protected UserService $createUserService) {}

    public function store(CreateUserRequest $request): JsonResponse
    {
        $requestValidated = $request->validated();

        try {
            $data = new CreateUserDto(
                $requestValidated['name'],
                new Email($requestValidated['email']),
                new Password($requestValidated['password']),
                new ZipCode($requestValidated['zip_code'])
            );
            $user = $this->createUserService->create($data);

            return new JsonResponse(new CreatedUserResource($user));
        } catch (\Exception $exception) {
            return new JsonResponse(
                ['message' => $exception->getMessage()],
                422
            );
        }
    }
}
