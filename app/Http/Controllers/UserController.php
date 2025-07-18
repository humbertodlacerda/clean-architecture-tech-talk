<?php

namespace App\Http\Controllers;

use App\Domain\User\Services\CreateUserService;
use App\Http\Requests\CreateUserRequest;
use Application\Dto\User\CreateUserDto;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(protected CreateUserService $createUserService) {}

    public function index()
    {
        //
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $requestValidated = $request->validated();
        $data = new CreateUserDto(
            $requestValidated['name'],
            $requestValidated['email'],
            $requestValidated['password'],
            $requestValidated['zip_code']
        );
        $user = $this->createUserService->create($data);

        return new JsonResponse($user);
    }
}
