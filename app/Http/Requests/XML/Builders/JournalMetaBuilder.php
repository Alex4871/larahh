<?php

namespace App\Http\Requests\XML\Builders;

use App\Http\Requests\XML\Helpers\DomHelper;
use App\Models\Journal;
use DOMElement;

class JournalMetaBuilder extends AbstractBuilder
{
    public function __construct(
        protected DomHelper $domHelper,
        private readonly Journal $journal
    ) {
        parent::__construct($domHelper);
    }

    public function build(DOMElement $parent): void
    {
        $journalMeta = $this->domHelper->append(
            $this->domHelper->createNode('journal-meta'),
            $parent
        );
        $this->domHelper->append(
            $this->domHelper->createNode(
                'journal-id',
                $this->journal->title_en,
                ['journal-id-type' => 'publisher-id']
            ),
            $journalMeta
        );
        $journalTitleGroup = $this->domHelper->append(
            $this->domHelper->createNode('journal-title-group'),
            $journalMeta
        );
        $this->domHelper->append(
            $this->domHelper->createNode(
                'journal-title',
                $this->journal->title_en,
                ['xml:lang' => 'en']
            ),
            $journalTitleGroup
        );
        $transTitleGroup = $this->domHelper->append(
            $this->domHelper->createNode(
                'trans-title-group',
                '',
                ['xml:lang' => 'ru']
            ),
            $journalTitleGroup
        );
        $this->domHelper->append(
            $this->domHelper->createNode(
                'trans-title',
                $this->journal->title_ru
            ),
            $transTitleGroup
        );

    }


}
