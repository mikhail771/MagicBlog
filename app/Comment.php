<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const STATUS_ALLOW = 1;
    const STATUS_DISALLOW = 0;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function allow()
    {
        $this->status = self::STATUS_ALLOW;
        $this->save();
    }

    public function disAllow()
    {
        $this->status = self::STATUS_DISALLOW;
        $this->save();
    }

    public function toggleStatus()
    {
        if ($this->status == self::STATUS_DISALLOW){
            return $this->allow();
        }

        return $this->disAllow();
    }

    public function remove()
    {
        $this->delete();
    }

    public function getComments()
    {
        return $this->comments()->where('status', 1)->get();
    }
}
