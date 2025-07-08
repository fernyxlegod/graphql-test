<?php

namespace App\GraphQL\Queries;

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

        // 2. Находим токен в базе
        $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            throw new \Exception('Invalid token');
        }

        // 3. Возвращаем пользователя
        return $accessToken->tokenable;
    }
}
