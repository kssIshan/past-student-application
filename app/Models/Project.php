<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'duration',
        'description',
        'start_date',
        'end_date'
    ];
    //union_project
    public function unions()
    {
        return $this->belongsToMany(Union::class);
    }
    // public function students()
    // {
    //     return $this->belongsToMany(Student::class, 'student_union_project')
    //         ->withPivot('student_id', 'union_project_id'); // Adjust accordingly
    // }
    // public function students()
    // {
    //     return $this->belongsToMany(Student::class, 'student_project')
    //         ->withPivot('student_id', 'project_id'); // Adjust accordingly
    // }
}
