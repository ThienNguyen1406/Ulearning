<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_token',
        'name',
        'thumbnail',
        'video',
        'description',
        'type_id',
        'price',
        'lesson_num',
        'video_length',
        'follow',
        'score',
    ];

    // Relationship with CourseType
    public function courseType()
    {
        return $this->belongsTo(CourseType::class, 'type_id');
    }
}
