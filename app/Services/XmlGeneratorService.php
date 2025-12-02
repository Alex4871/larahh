<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Author;
use App\Models\Journal;
use DOMDocument;
use DOMElement;
use DOMException;
use DOMNode;
use Illuminate\Database\Eloquent\Collection;

class XmlGeneratorService
{
    public function __construct(
        protected DomDocument $dom
    )
    {   $this->dom->encoding = 'UTF-8';
        $this->dom->formatOutput = true;
    }

    public function generateXML(Journal $journal, Article $article): false|string
    {
        $articleNode = $this->createOneNode(
            'article',
            $this->dom,
            '',
            [
                'xmlns:mml' => 'http://www.w3.org/1998/Math/MathML',
                'xmlns:xlink' => 'http://www.w3.org/1999/xlink',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xmlns:ali' => 'http://www.niso.org/schemas/ali/1.0/',
                'article-type' => 'other',
                'dtd-version' => '1.2',
                'xml:lang' => 'en'
            ]

        );
        $frontNode = $this->createOneNode('front', $articleNode);
        /*  <journal-meta>  */
        $this->generateJournalMeta($frontNode, $journal);
        /*  <article-meta>  */
        $this->generateArticleMeta($frontNode, $article);

        $this->createOneNode('body', $articleNode);

        $backNode = $this->createOneNode('back', $articleNode);
        $this->generateRefList($backNode, $article);

        return $this->dom->saveXML();
    }

    /**
     * Создаем блок <journal-meta>
     * @param DOMElement|DOMNode $parent - родитель для блока <journal-meta>
     * @param Journal $journal - модель журнала
     * @return void
     * @throws \DOMException
     */
    private function generateJournalMeta(DOMElement|DOMNode $parent, Journal $journal): void
    {
        $journalMeta = $parent->appendChild($this->dom->createElement('journal-meta'));

        $this->createOneNode(
            'journal-id',
            $journalMeta,
            $journal->title_en,
            ['journal-id-type' => 'publisher-id']
        );

        $journalTitleGroup = $this->createOneNode('journal-title-group', $journalMeta);

        $this->createOneNode(
            'journal-title',
            $journalTitleGroup,
            $journal->title_en,
            ['xml:lang' => 'en']
        );

        $transTitleGroup = $this->createOneNode(
            'trans_title_group',
            $journalTitleGroup,
            '',
            ['xml:lang' => 'ru']
        );

        $this->createOneNode('trans_title', $transTitleGroup, $journal->title_ru);

        $this->createOneNode(
            'issn',
            $journalMeta,
            $journal->issn,
            ['publication-format' => 'print']
        );

        $publisher = $this->createOneNode('publisher', $journalMeta);
        $this->createOneNode(
            'publisher-name',
            $publisher,
            $journal->publisher,
            ['xml:lang' => 'en']
        );
    }

    /**
     * Создаем блок <article-meta>
     * @param DOMElement|DOMNode $parent - родитель для блока <article-meta>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generateArticleMeta(DOMElement|DOMNode $parent, Article $article): void
    {
        $articleMeta = $this->createOneNode('article-meta', $parent);
        $this->createOneNode(
            'article-id',
            $articleMeta,
            $article->id,
            ['pub-id-type' => 'publisher-id']
        );
        $this->createOneNode(
            'article-id',
            $articleMeta,
            $article->doi,
            ['pub-id-type' => 'doi']
        );

        $this->generateArticleCategories($articleMeta, $article);
        $this->generateTitleGroup($articleMeta, $article);
        $this->generateContribGroup($articleMeta, $article);
        $this->generateAffAlternatives($articleMeta, $article);
        $this->generatePubDate($articleMeta, $article);

        $this->createOneNode('volume', $articleMeta, $article->journal->volume);
        $this->createOneNode('issue', $articleMeta, $article->journal->issue);
        $this->createOneNode('issue-title', $articleMeta, '', ['xml:lang' => 'en']);
        $this->createOneNode('issue-title', $articleMeta, '', ['xml:lang' => 'ru']);
        $this->createOneNode('fpage', $articleMeta, $article->f_page);
        $this->createOneNode('lpage', $articleMeta, $article->l_page);

        $this->generateHistory($articleMeta, $article);
        $this->generatePermissions($articleMeta, $article);

        $this->createOneNode('self-uri', $articleMeta, 'url адрес', ['xlink:href' => 'url адрес']);
        $this->generateAbstract($articleMeta, $article);
        $this->generateKwdGroup($articleMeta, $article);

        $this->createOneNode('funding-group', $articleMeta);
    }

    /**
     * Создаем блок <article-categories>
     * @param DOMElement|DOMNode $parent - родитель для блока <article-categories>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generateArticleCategories(DOMElement|DOMNode $parent, Article $article): void
    {
        $articleCategories = $this->createOneNode('article-categories', $parent);
        $subjGroupEng = $this->createOneNode(
            'subj-group',
            $articleCategories,
            '',
            [
                'subj-group-type' => 'toc-heading',
                'xml:lang' => 'en'
            ]
        );
        $this->createOneNode('subject', $subjGroupEng, $article->category_en);

        $subjGroupRu = $this->createOneNode(
            'subj-group',
            $articleCategories,
            '',
            [
                'subj-group-type' => 'toc-heading',
                'xml:lang' => 'ru'
            ]
        );
        $this->createOneNode('subject', $subjGroupRu, $article->category_ru);

        $subjGroupRu = $this->createOneNode(
            'subj-group',
            $articleCategories,
            '',
            [
                'subj-group-type' => 'article-type'
            ]
        );
        $this->createOneNode('subject', $subjGroupRu, $article->type);
    }

    /**
     * Создаем блок <title-group>
     * @param DOMElement|DOMNode $parent - одитель для блока <title-group>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generateTitleGroup(DOMElement|DOMNode $parent, Article $article): void
    {
        $titleGroup = $this->createOneNode('title-group', $parent);
        $this->createOneNode(
            'article-title',
            $titleGroup,
            $article->title_en,
            ['xml:lang' => 'en']
        );
        $transTitleGroup = $this->createOneNode(
            'trans-title-group',
            $titleGroup,
            '',
            ['xml:lang' => 'ru']
        );
        $this->createOneNode(
            'trans-title',
            $transTitleGroup,
            $article->title_ru,
        );
    }

    /**
     * Создаем блок <contrib-group> - авторы
     * @param DOMElement|DOMNode $parent - родитель для блока <contrib-group>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generateContribGroup(DOMElement|DOMNode $parent, Article $article)
    {
        $authors = $article->authors;
        $uniqueWorkPlaces = $this->getUniqueWorkPlaces($authors);
        $ruUniqueWorkPlaces = array_map(function ($ruWorkPlace) {
            return $ruWorkPlace['ru'] ?? '';
        }, $uniqueWorkPlaces);
        $contribGroup = $this->createOneNode(
            'contrib-group',
            $parent
        );

        foreach ($authors as $author) {
            $authorIdAttribute = array_search($author->job_ru, $ruUniqueWorkPlaces);
            $this->generateOneContrib($contribGroup, $author, $authorIdAttribute);
        }
    }

    /**
     * Создаем блок <contrib> - один автор
     * @param DOMElement|DOMNode $parent - родитель для блока <contrib>
     * @param Author $author - модель Автора
     * @param int $authorSerialNumber - порядковый номер автора в статье
     * @return void
     * @throws \DOMException
     */
    private function generateOneContrib(DOMElement|DOMNode $parent, Author $author, string $authorIdAttribute): void
    {
        $contrib = $this->createOneNode(
            'contrib',
            $parent,
            '',
            ['contrib-type' => 'author']
        );
        $this->createOneNode(
            'contrib-id',
            $contrib,
            'https://orcid.org/' . $author->orcid,
            ['contrib-id-type' => 'orcid']
        );
        $nameAlternatives = $this->createOneNode('name-alternatives', $contrib);

        $name = $this->createOneNode(
            'name',
            $nameAlternatives,
            '',
            ['xml:lang' => 'en']
        );
        $this->createOneNode('surname', $name, $author->surname_en);
        $this->createOneNode('given-names', $name, $author->initials_en);

        $name = $this->createOneNode(
            'name',
            $nameAlternatives,
            '',
            ['xml:lang' => 'ru']
        );
        $this->createOneNode('surname', $name, $author->surname_ru);
        $this->createOneNode('given-names', $name, $author->initials_ru);

        $bio = $this->createOneNode(
            'bio',
            $contrib,
            '',
            ['xml:lang' => 'en']
        );
        $this->createOneNode('p', $bio, $author->rank_en);

        $bio = $this->createOneNode(
            'bio',
            $contrib,
            '',
            ['xml:lang' => 'ru']
        );
        $this->createOneNode('p', $bio, $author->rank_ru);

        $this->createOneNode('email', $contrib, $author->email);
        $this->createOneNode(
            'xref',
            $contrib,
            '',
            [
                'ref-type' => 'aff',
                'rid' => $authorIdAttribute
            ]
        );
    }

    /**
     * @param DOMElement|DOMNode $parent - родитель для тега <aff-alternatives>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generateAffAlternatives(DOMElement|DOMNode $parent, Article $article)
    {
        $authors = $article->authors;
        $uniqueWorkPlaces = $this->getUniqueWorkPlaces($authors);

        foreach ($uniqueWorkPlaces as $uniqueWorkPlaceKey => $uniqueWorkPlaceValues) {
            $affAlternatives = $this->createOneNode(
                'aff-alternatives',
                $parent,
                '',
                ['id' => $uniqueWorkPlaceKey]
            );
            foreach ($uniqueWorkPlaceValues as $lang => $instituteName) {
                $aff = $this->createOneNode('aff', $affAlternatives);
                $this->createOneNode(
                    'institution',
                    $aff,
                    $instituteName,
                    ['xml:lang' => $lang]
                );
            }

        }

    }

    /**
     * Создаем блок <pub-date>
     * @param DOMElement|DOMNode $parent - родитель для тега <pub-date>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generatePubDate(DOMElement|DOMNode $parent, Article $article)
    {
        $pubDate = $this->createOneNode(
            'pub-date',
            $parent,
            '',
            [
                'date-type' => 'pub',
                'iso-8601-date' => $article->journal->date,
                'publication-format' => 'electronic'
            ]
        );
        $this->createOneNode(
            'day',
            $pubDate,
            date('d', strtotime($article->journal->date))
        );
        $this->createOneNode(
            'month',
            $pubDate,
            date('m', strtotime($article->journal->date))
        );
        $this->createOneNode(
            'year',
            $pubDate,
            date('Y', strtotime($article->journal->date))
        );
    }

    /**
     * Создаем блок <history>
     * @param DOMElement|DOMNode $parent - родитель для блока <history>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generateHistory(DOMElement|DOMNode $parent, Article $article)
    {
        $history = $this->createOneNode('history', $parent);
        $date = $this->createOneNode(
            'date',
            $history,
            '',
            [
                'date-type' => 'received',
                'iso-8601-date' => $article->date
            ]
        );
        $this->createOneNode(
            'day',
            $date,
            date('d', strtotime($article->date))
        );
        $this->createOneNode(
            'month',
            $date,
            date('m', strtotime($article->date))
        );
        $this->createOneNode(
            'year',
            $date,
            date('Y', strtotime($article->date))
        );

    }

    /**
     * Создаем блок <permissions>
     * @param DOMElement|DOMNode $parent родитель для блока <permissions>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generatePermissions(DOMElement|DOMNode $parent, Article $article)
    {
        $permissions = $this->createOneNode('permissions', $parent);
        $this->createOneNode(
            'copyright-statement',
            $permissions,
            'Copyright ©;' . $article->copyright_en,
            ['xml:lang' => 'en']
        );
        $this->createOneNode(
            'copyright-statement',
            $permissions,
            'Copyright ©;' . $article->copyright_ru,
            ['xml:lang' => 'ru']
        );
        $this->createOneNode(
            'copyright-year',
            $permissions,
            date('Y', strtotime($article->date))
        );
        $this->createOneNode(
            'copyright-holder',
            $permissions,
            $article->copyright_en,
            ['xml:lang' => 'en']
        );
        $this->createOneNode(
            'copyright-holder',
            $permissions,
            $article->copyright_ru,
            ['xml:lang' => 'ru']
        );
        $license = $this->createOneNode('license', $permissions);
        $this->createOneNode(
            'ali:license_ref',
            $license,
            'https://creativecommons.org/licenses/by/4.0',
            ['xmlns:ali' => 'http://www.niso.org/schemas/ali/1.0/']
        );
    }

    /**
     * Создаем блоки <abstract> и <trans-abstract>
     * @param DOMElement|DOMNode $parent - родитель для блоков  <abstract> и <trans-abstract>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generateAbstract(DOMElement|DOMNode $parent, Article $article)
    {
        $abstract = $this->createOneNode('abstract', $parent, '', ['xml:lang' => 'en']);
        $this->createOneNode('p', $abstract, $article->annotation_en);

        $transAbstract = $this->createOneNode('trans-abstract', $parent, '', ['xml:lang' => 'ru']);
        $this->createOneNode('p', $transAbstract, $article->annotation_ru);
    }

    /**
     * Создаем блоки <kwd-group> - ключевые слова
     * @param DOMElement|DOMNode $parent - родитель для блоков <kwd-group>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generateKwdGroup(DOMElement|DOMNode $parent, Article $article)
    {
        $kwdGroupEng = $this->createOneNode(
            'kwd-group',
            $parent,
            '',
            ['xml:lang' => 'en']
        );

        foreach ($article->keywords_eng as $keyword) {
            $this->createOneNode('kwd', $kwdGroupEng, $keyword->name);
        }

        $kwdGroupRu = $this->createOneNode(
            'kwd-group',
            $parent,
            '',
            ['xml:lang' => 'ru']
        );

        foreach ($article->keywords_ru as $keyword) {
            $this->createOneNode('kwd', $kwdGroupRu, $keyword->name);
        }
    }

    /**
     * Создаем блок <ref-list> - писок литературы
     * @param DOMElement|DOMNode $parent - родитель для блока <ref-list>
     * @param Article $article - модель статьи
     * @return void
     * @throws \DOMException
     */
    private function generateRefList(DOMElement|DOMNode $parent, Article $article)
    {
        $referencesRu = explode("\n", $article->references_ru);
        $referencesEng = explode("\n", $article->references_en);

        $count = count($referencesEng);

        $refList = $this->createOneNode('ref-list', $parent);

        for ($i = 0; $i < $count; $i++) {

            $ref = $this->createOneNode('ref', $refList, '', ['id' => 'B'.$i+1]);
            $this->createOneNode('label', $ref, $i+1 . '.');
            $citationAlternatives = $this->createOneNode('citation-alternatives', $ref);

            $this->createOneNode(
                'mixed-citation',
                $citationAlternatives,
                $referencesEng[$i],
                ['xml:lang' => 'en']
            );
            $this->createOneNode(
                'mixed-citation',
                $citationAlternatives,
                $referencesRu[$i],
                ['xml:lang' => 'ru']
            );

        }

    }


    /**
     * @param string $nodeName - название создаваемого тега
     * @param DOMDocument|DOMElement $parent - родитель для создаваемого тега
     * @param string|null $nodeValue - значение создаваемого тега (контент заключенный в него)
     * @param array|null $attrs - массив атрибутов в котором ключ - название аттрибута, а значение - значение
     * @return DOMElement - объект созданного тега
     * @throws DOMException
     */
    private function createOneNode (
        string $nodeName,
        DOMDocument|DOMElement $parent,
        ?string $nodeValue = null,
        ?array $attrs = null,
    ): DOMElement  {
        $created = $this->dom->createElement($nodeName, $nodeValue ?? '');
        if($attrs !== null) {
            foreach ($attrs as $attrName => $attrValue) {
                $created->setAttribute($attrName, $attrValue);
            }
        }
        return $parent->appendChild($created);
    }


    /**
     * Получаем массив уникальных мест работы на русском и английском языках
     * Структура следующая:
     * [
     * 'aff1' => ['ru' => 'МГУ', 'en' => 'Lomonosov Moscow State University'],
     * 'aff2' => ['ru' => 'Шаньдунский университет', 'en' => 'Shandong University'],
     * ]
     * @param Collection $authors - коллекция моделей авторов
     * @return array - массив с уникальными местами работы авторов конкретной статьи
     */
    private function getUniqueWorkPlaces(Collection $authors): array
    {
        $seen = [];
        $uniqueWorkPlaces = [];

        foreach ($authors as $author) {
           $jobRu = trim($author->job_ru);
           $jobEng = trim($author->job_en);
           $key = $jobRu . '|' . $jobEng;
           if (!isset($seen[$key])) {
               $seen[$key] = true;
           }
           $uniqueWorkPlaces['aff' . count($seen)] = ['ru' => $jobRu, 'en' => $jobEng];
        }
        return $uniqueWorkPlaces;
    }


}
