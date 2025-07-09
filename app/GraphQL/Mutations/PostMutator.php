<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PostMutator
{
    public function create($rootValue, array $args, GraphQLContext $context)
    {
        $token = $context->request()->bearerToken();

        if (!$token) {
            throw new \RuntimeException('Missing authorization token');
        }

        $user = User::where('api_token',
            config('auth.guards.api.hash') ? hash('sha256', $token) : $token
        )->first();

        if (!$user) {
            throw new \RuntimeException('Invalid authentication token');
        }

        $post = new Post($args);
        $post->user_id = $user->id;
        $post->save();

        return $post;
    }
}
