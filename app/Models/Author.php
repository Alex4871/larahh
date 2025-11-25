<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    protected $table = 'authors';

    protected $fillable = [
        'surname_ru', 'surname_en', 'initials_ru',
        'initials_en', 'orcid', 'email', 'position_ru',
        'position_en', 'job_ru', 'job_en', 'rank_ru', 'rank_en'
    ];

    public $timestamps = false;

    public function articles(): belongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
