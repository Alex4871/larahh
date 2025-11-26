<?php

namespace App\Http\Requests\XML\Helpers;

use DOMDocument;
use DOMElement;
use DOMException;

class DomHelper
{
    public function __construct(public DOMDocument $dom)
    {
        $dom->encoding = 'UTF-8';
        $dom->formatOutput = true;
    }

    /**
     * Создаем тег, при необходимости присваиваем ему значение и аттрибуты
     * @param string $name - название тега
     * @param string|null $value - значение тега
     * @param array|null $attributes - атрбуты тега
     * @return DOMElement - созданный тег
     * @throws DOMException
     */
    public function createNode(
        string $name,
        ?string $value = null,
        ?array $attributes = null
    ): DOMElement {
        $element = $this->dom->createElement($name, $value ?? '');
        if ($attributes !== null) {
            foreach ($attributes as $name => $value) {
                $element->setAttribute($name, $value);
            }
        }
        return $element;
    }

    /**
     * Добавляем один тег в другой
     * @param DOMElement $node - тег, который надо вставить
     * @param DOMElement $parent - родитель, в который нужно вставить тег
     * @return DOMElement - добавленный узел
     */
    public function append(DOMElement $node, DOMElement $parent): DOMElement
    {
        return $parent->appendChild($node);
    }

    /**
     * Сохраняем созданный xml
     * @return string - xml-строка
     */
    public function save(): string
    {
        return $this->dom->saveXML();
    }
}
