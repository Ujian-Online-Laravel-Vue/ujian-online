<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'exam_id',
        'title',
        'start_time',
        'end_time',
    ];

    /**
     * exam_groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exam_groups()
    {
        return $this->hasMany(ExamGroup::class);
    }

    public function students(){
       return $this->hasMany(Student::class,'exam_groups','exam_session_id','student_id');
    }

    /**
     * exam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }


    public function pengawas()
    {
        return $this->belongsTo(User::class);
    }
}
