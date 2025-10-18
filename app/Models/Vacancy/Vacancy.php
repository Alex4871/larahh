<?php

namespace App\Models\Vacancy;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = 'vacancies';

    protected $fillable = [
        'title', 'work_schedule', 'salary',
        'numberOfSpecialist', 'gender', 'experience',
        'responsibilities', 'conditions', 'addInformation'
    ];
}
