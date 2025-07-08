<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Nuwave\Lighthouse\Http\GraphQLController;

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/graphql', function () {
    return <<<'HTML'
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>GraphQL Playground</title>
        <style>
            body { margin: 0; padding: 0; }
            #root { height: 100vh; }
            .playgroundOverlay { z-index: 100 !important; }
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/graphql-playground-react@1.7.26/build/static/css/index.css">
    </head>
    <body>
    <div id="root"></div>
    <script src="https://cdn.jsdelivr.net/npm/graphql-playground-react@1.7.26/build/static/js/middleware.js"></script>
    <script>
        window.addEventListener('load', function() {
            GraphQLPlayground.init(document.getElementById('root'), {
                endpoint: window.location.origin + '/graphql',
                settings: {
                    'editor.theme': 'dark',
                    'schema.polling.enable': false,
                    'editor.cursorShape': 'line'
                }
            });
        });
    </script>
    </body>
    </html>
    HTML;
});
