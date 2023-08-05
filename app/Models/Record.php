<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'user_id', 'student_id'];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
