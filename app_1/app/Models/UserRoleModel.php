<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleModel extends Model
{
    protected $table='role_tbl';
    protected $fillable=['id','name','status','created_at','updated_at'];
    use HasFactory;
}
