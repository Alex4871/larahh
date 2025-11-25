<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KeywordRus extends Model
{
    protected $table = 'keywords_ru';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
