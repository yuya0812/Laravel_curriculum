<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLikesTable extends Migration
{
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['user_id']);
            $table->dropForeign(['post_id']);

            // 一意制約インデックスを削除
            $table->dropUnique('likes_user_id_post_id_unique');

            // 必要に応じて外部キー制約を再追加
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            // 逆に、外部キー制約を削除し、インデックスを再追加
            $table->dropForeign(['user_id']);
            $table->dropForeign(['post_id']);

            $table->unique(['user_id', 'post_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
}
