<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_name', 'content'];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }


    public function replies()
    {
        return $this->hasMany(ReplyComment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replyComments()
    {
        return $this->hasMany(ReplyComment::class, 'comment_id');
    }
}
