<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'start_date',
        'status',
    ];
    //union_project
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
    //student_union
    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->withPivot('position', 'duration', 'join_date', 'leave_date')
            ->withTimestamps();
    }
}
