<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'journal_id', 'doi', 'edn', 'udk',
        'title_ru', 'title_en', 'annotation_ru',
        'annotation_en', 'f_page', 'l_page', 'date',
        'references_ru', 'references_en'
    ];
    public $timestamps = false;

    public function journal(): BelongsTo
    {
        return $this->belongsTo(Journal::class);
    }

    public function keywords_ru(): BelongsToMany
    {
        return $this->belongsToMany(KeywordRus::class, 'article_keywords_ru', 'article_id', 'keyword_id');
    }

    public function keywords_eng(): BelongsToMany
    {
        return $this->belongsToMany(KeywordEng::class, 'article_keywords_eng', 'article_id', 'keyword_id');
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class , 'article_authors', 'article_id', 'author_id');
    }
}
