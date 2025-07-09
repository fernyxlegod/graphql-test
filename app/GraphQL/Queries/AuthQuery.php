<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AuthQuery
{
    public function __invoke($root, array $args, GraphQLContext $context)
    {
        // 1. Получаем токен из заголовка
        $token = $context->request()->bearerToken();

        if (!$token) {
            throw new \Exception('Authorization token is missing');
        }

        // 2. Находим пользователя по токену
        $user = User::where('api_token', hash('sha256', $token))->first();

        if (!$user) {
            throw new \Exception('Invalid token');
        }

        return $user;
    }
}
