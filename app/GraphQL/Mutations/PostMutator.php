<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PostMutator
{
    public function create($rootValue, array $args, GraphQLContext $context)
    {
        // Явная проверка (на случай, если @guard не сработает)
        if (!Auth::check()) {
            throw new \RuntimeException('You must be logged in to create a post.');
        }

        $post = new Post($args);
        $context->user()->posts()->save($post); // Работает только с Sanctum

        return $post;
    }
}
