<?php

namespace App\Http\Requests\XML;

use App\Http\Requests\XML\Builders\JournalMetaBuilder;
use App\Http\Requests\XML\Helpers\DomHelper;
use App\Models\Article;
use App\Models\Journal;

class JatsXmlGenerator
{
    public function __construct(
        protected DomHelper $domHelper
    )
    {}

    public function generate(Journal $journal, Article $article): string
    {
        $root = $this->domHelper->createNode(
            'article',
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
        $this->domHelper->append($root, $this->domHelper->dom);
        $front = $this->domHelper->append($this->domHelper->createNode('front'), $root);
        (new JournalMetaBuilder($this->domHelper, $journal))->build($front);
        $back = $this->domHelper->append($this->domHelper->createNode('back'), $root);
        return $this->domHelper->save();
    }

}
