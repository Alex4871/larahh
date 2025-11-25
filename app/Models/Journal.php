<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Journal extends Model
{
    protected $table = 'journals';

    protected $fillable = [
        'title_ru', 'title_en',
        'issn', 'eissn',
        'volume', 'issue',
        'date', 'publisher'
    ];

    public $timestamps = false;

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
