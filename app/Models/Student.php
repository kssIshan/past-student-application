<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reg_no',
        'uuid',
        'user_id',
        'nic',
        'first_name',
        'last_name',
        'dob',
        'date_of_admission',
        'date_of_leave',
        'address',
        'email',
        'mobile_no',
        'mobile_no2',
        'land_no',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function exams(): HasMany
    {

        return $this->hasMany(Exam::class);
    }
    //sport_student
    // public function sports()
    // {
    //     return $this->belongsToMany(Sport::class);
    // }
    public function sports()
    {
        return $this->belongsToMany(Sport::class, 'sport_student')
            ->withPivot('period')
            ->withTimestamps(); // Include the pivot table column for period
    }

    //student_union
    public function unions()
    {
        return $this->belongsToMany(Union::class)
            ->withPivot('position', 'duration', 'join_date', 'leave_date')
            ->withTimestamps();
    }

    public function achievements(): HasMany
    {

        return $this->hasMany(Achievement::class);
    }
    // public function projects()
    // {
    //     return $this->belongsToMany(Project::class, 'student_union_project')
    //         ->withPivot('student_id', 'union_project_id');  //Adjust accordingly
    // }
    // public function projects()
    // {
    //     return $this->belongsToMany(Project::class, 'student_project')
    //         ->withPivot('student_id', 'project_id'); // Adjust accordingly
    // }
}
