<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const IS_BANNED = 1;
    const IS_ACTIVE = 0;
    const IS_ADMIN = 1;
    const IS_NOT_ADMIN = 0;
    const UPLOADS_PACKAGE = 'uploads/';
    const NO_AVATAR = '/img/no-avatar.jpeg';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function add(array $fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->save();

        return $user;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function generatePassword(string $password)
    {
        if ($password != null)
        {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove()
    {
        $this->removeAvatar();
        $this->delete();
    }

    public function uploadAvatar($image)
    {
//        if ($image == null) { return; }

        $this->removeAvatar();
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs(self::UPLOADS_PACKAGE, $filename);
        $this->avatar = $filename;
        $this->save();
    }

    public function removeAvatar()
    {
        if ($this->avatar != null)
        {
            Storage::delete( self::UPLOADS_PACKAGE . $this->avatar);
        }
    }

    public function getImage()
    {
        if ($this->avatar == null)
        {
            return self::NO_AVATAR;
        }

        return '/'. self::UPLOADS_PACKAGE . $this->avatar;
    }

    public function makeAdmin()
    {
        $this->is_admin = self::IS_ADMIN;
        $this->save();
    }

    public function makeNormal()
    {
        $this->is_admin = self::IS_NOT_ADMIN;
        $this->save();
    }

    public function toggleAdmin($value)
    {
        if ($value == null)
        {
            return $this->makeNormal();
        }

        return $this->makeAdmin();
    }

    public function ban()
    {
        $this->status = User::IS_BANNED;
        $this->save();
    }

    public function unban()
    {
        $this->status = User::IS_ACTIVE;
        $this->save();
    }

    public function toggleBan($value)
    {
        if ($value == null)
        {
            return $this->unban();
        }

        return $this->ban();
    }
}
