<?php

namespace fb2\src;

use fb2\src\Models\Book;
use fb2\src\Models\TitleInfo;
use fb2\src\Models\Chapters;

class FBController {

    private $xml;
    protected $book;

    public function __construct($xml) {
        $this->load($xml);
    }

    private function load($xml): void {
      $this->xml = simplexml_load_string($xml);
      $this->book = new Book();
      $this->initParser();
    }

    private function initParser() {
        $this->parseTitleInfo();
        $this->parseChapters();
    }

    public function getBook() {
        return $this->book;
    }

    private function parseTitleInfo(): void {
        $items = [];
        $node = $this->xml->description->{'title-info'};
        $this->book->setTitleInfo((new TitleInfo())->parse($node));
    }
    
    private function parseChapters(): void {
        $items = [];
        $nodes = $this->xml->body->section ?? [];
        $this->book->setChapters((new Chapters())->parse($nodes));
    }
}