<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sport extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'sport_name'

    ];
    //sport_student
    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->withPivot('period')
            ->withTimestamps();
    }
    public function achievements(): HasMany
    {

        return $this->hasMany(Achievement::class);
    }
}
