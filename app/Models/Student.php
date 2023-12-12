<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'dob',
        'date_of_admission',
        'date_of_leave',
        'address',
        'email',
        'mobile_no',
        'land_no',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
