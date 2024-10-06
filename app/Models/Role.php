<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    // Một vai trò có nhiều quyền
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }

    // Một vai trò có nhiều người dùng
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
