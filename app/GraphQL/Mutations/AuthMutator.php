<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AuthMutator
{
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $credentials = Arr::only($args, ['email', 'password']);

        if (!Auth::attempt($credentials)) {
            throw new \RuntimeException('Invalid credentials.');
        }

        $user = Auth::user();
        $token = $user->createToken('graphql-token')->plainTextToken; // Sanctum токен

        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}
