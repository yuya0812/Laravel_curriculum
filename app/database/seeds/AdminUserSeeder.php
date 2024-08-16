<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;// ユーザーモデルをインポート
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => '管理者',
            'email' => 'guttii0812@yahoo.co.jp',
            'password' => Hash::make('password'), // 安全なパスワードに置き換えてください
            'role' => User::ROLE_ADMIN, // 管理者として登録
        ]);
    }
}

