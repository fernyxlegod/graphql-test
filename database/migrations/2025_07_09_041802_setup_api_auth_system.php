<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Добавляем api_token если его нет
        if (!Schema::hasColumn('users', 'api_token')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('api_token', 80)
                    ->unique()
                    ->nullable()
                    ->default(null)
                    ->after('remember_token');
            });
        }

        // Если нужно удалить Sanctum-специфичные таблицы (опционально)
        if (Schema::hasTable('personal_access_tokens')) {
            Schema::drop('personal_access_tokens');
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Откатываем изменения
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('api_token');
        });
    }
};
