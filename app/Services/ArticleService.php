<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Author;
use App\Models\KeywordEng;
use App\Models\KeywordRus;

class ArticleService
{
    /**
     * @param array $data - данные по статье, пришедшие из формы, и прошедшие валидацию
     * @return void - сохраняем эти данные по своим таблицам
     */
    public function createArticle(array $data, int $journal_id): void
    {
        $data['journal_id'] = $journal_id;

        $keywords_ru = $this->extractKeywords($data['keywords_ru']);
        $keywords_eng = $this->extractKeywords($data['keywords_eng']);
        $authors = $this->trimAuthors($data['authors']);
        $references_ru = $this->normalizeReferences($data['references_ru']);
        $references_eng = $this->normalizeReferences($data['references_en']);

        unset($data['keywords_ru'], $data['keywords_eng'], $data['authors'], $data['references_ru'], $data['references_en']);

        $article = Article::create($data);
        $this->syncKeywords($article, $keywords_ru, $keywords_eng);
        $this->syncAuthors($article, $authors);
        $article->update(['references_ru' => $references_ru, 'references_en' => $references_eng]);
    }

    /**
     * @param string $keywordsStr - строка ключевых слов пришедших из формы
     * @return array - массив ключевых слов, без концевых пробелов и пустых строк
     */
    private function extractKeywords(string $keywordsStr): array
    {
        $keywordsArr = explode(',', $keywordsStr);
        $res = [];
        foreach ($keywordsArr as $keyword) {
            $trimmed = trim($keyword);
            if (!empty($trimmed)) {
                $res[] = $trimmed;
            }
        }
        return $res;
    }

    /**
     * @param Article $article - модель статьи
     * @param array $keywordsArrRu - массив ключевых слов на русском
     * @param array $keywordsArrEng - массив ключевых слов на английском
     * @return void - добавляем ключевые слова в бд и закрепляем их за статьей
     */
    private function syncKeywords(Article $article, array $keywordsArrRu, array $keywordsArrEng): void
    {
        $keywordsIdsRu = array_map(function ($keywordRu) {
            return KeywordRus::firstOrcreate(['name' => $keywordRu])->id;
        }, $keywordsArrRu);

        $keywordsIdsEng = array_map(function ($keywordEng) {
            return KeywordEng::firstOrcreate(['name' => $keywordEng])->id;
        }, $keywordsArrEng);

        $article->keywords_ru()->sync($keywordsIdsRu);
        $article->keywords_eng()->sync($keywordsIdsEng);
    }

    /**
     * @param array $authors - массив авторов пришедший из формы
     * @return array - массив авторов, у которых все поля пропустили через trim()
     */
    private function trimAuthors(array $authors): array
    {
        return array_map(function (array $author) {
            foreach ($author as $key => $field) {
                $author[$key] = trim($field);
            }
            return $author;
        }, $authors);
    }

    /**
     * @param Article $article - модель статьи
     * @param array $authors - массив авторов
     * @return void - добавляем авторов в базу и закрепляем за статьей
     */
    private function syncAuthors(Article $article, array $authors): void
    {
        $authorsIds = array_map(function ($author) {
            return Author::create($author)->id;
        }, $authors);

        $article->authors()->sync($authorsIds);
    }

    /**
     * @param string $references - строка со списком литературы
     * @return string - строка без пустых строк и концевых пробелов
     */
    private function normalizeReferences(string $references): string
    {
        $res = [];
        $referencesArr = explode("\n", $references);
        foreach ($referencesArr as $reference) {
            $trimmed = trim($reference);
            if (!empty($trimmed)) {
                $res[] = $trimmed;
            }
        }
        return implode("\n", $res);
    }

}
