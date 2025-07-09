<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AuthMutator
{
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $credentials = Arr::only($args, ['email', 'password']);

        if (!Auth::once($credentials)) { // Используем once для безсессионной проверки
            throw new \RuntimeException('Invalid credentials.');
        }

        return Auth::user()->createAuthToken();
    }
}
