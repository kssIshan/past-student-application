<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievement extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'sport_id',
        'student_id',
        'achievement_name',
        'achievement_date',
        'achievement_type',
        'achievement_level',
        'achievement_status',
        'age_gap',
        'description'
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
