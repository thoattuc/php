<?php

namespace App\Models;

use App\Models\ClassScheduleModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $fillable = ['id','name', 'email', 'password', 'idRole', 'status', 'phone'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];
    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserRoleModel::class, 'id');
    }

    public function schedule(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this -> hasMany(ClassScheduleModel::class, 'idTeacher');
    }

    public function process(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this -> hasMany(ProcessModel::class, 'idTeacher');
    }

}
