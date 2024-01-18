<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'index_no',
        'type',
        'exam_year',
        'attempt',
        'island_rank',
        'district_rank',
        'z_score',
        'cut_of_marks',
        'subject_stream',
        'is_pass',
    ];

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
