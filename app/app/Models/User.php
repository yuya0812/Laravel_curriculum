<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    // ユーザーロールの定数定義
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * 管理者かどうかを判定するメソッド
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }
    
     //多対多のリレーションを書く
     public function likes()
     {
         return $this->belongsToMany('App\Models\Post','likes','user_id','post_id')->withTimestamps();
     }
 
     //この投稿に対して既にlikeしたかどうかを判別する
     public function isLike($postId)
     {
       return $this->likes()->where('post_id',$postId)->exists();
     }
 
     //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
     public function like($postId)
     {
       if($this->isLike($postId)){
         //もし既に「いいね」していたら何もしない
       } else {
         $this->likes()->attach($postId);
       }
     }
 
     //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
     public function unlike($postId)
     {
       if($this->isLike($postId)){
         //もし既に「いいね」していたら消す
         $this->likes()->detach($postId);
       } else {
       }
     }
}
