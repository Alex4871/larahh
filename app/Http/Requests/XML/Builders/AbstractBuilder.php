<?php

namespace App\Http\Requests\XML\Builders;

use App\Http\Requests\XML\Helpers\DomHelper;
use DOMElement;

abstract class AbstractBuilder
{
    /**
     * @param DomHelper $domHelper - экземпляр объекта обертки над DOMDocument
     */
    public function __construct(
        protected DomHelper $domHelper
    )
    {}

    /**
     * Вставка контента в родительский тег
     * @param DOMElement $parent - родительский тег, куда вставляется контент
     * @return void
     */
    abstract protected function build(DOMElement $parent): void;
}
