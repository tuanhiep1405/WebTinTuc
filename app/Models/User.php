<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // Khai báo các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'name',
        'email',
        'password',
        // Thêm các thuộc tính khác nếu cần
    ];

    // Nếu cần, bạn có thể thêm các thuộc tính ẩn
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Nếu cần, có thể thêm các kiểu dữ liệu cho thuộc tính
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
