<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['class_info_id', 'name', 'email', 'age', 'phone', 'address'];

    public function classInfo(): BelongsTo
    {
        return $this->belongsTo(ClassInfo::class, 'class_info_id', 'id');
    }
}
