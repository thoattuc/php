<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessModel extends Model
{
    use HasFactory;

    protected $table = 'process_tbl';

    protected $fillable = ['id', 'name', 'idTeacher', 'schedules', 'idCourses', 'duration', 'pass'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id');
    }

}
