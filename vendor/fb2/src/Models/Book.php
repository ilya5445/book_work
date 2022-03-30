<?php

namespace fb2\src\Models;

class Book {

    private $authors = [];
    private $titleInfo = [];
    private $chapters = [];

    /**
     * Get the value of authors
     */ 
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set the value of authors
     *
     * @return  self
     */ 
    public function setAuthors($authors)
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * Get the value of info
     */ 
    public function getTitleInfo()
    {
        return $this->titleInfo;
    }

    /**
     * Set the value of info
     *
     * @return  self
     */ 
    public function setTitleInfo($titleInfo)
    {
        $this->titleInfo = $titleInfo;

        return $this;
    }

    /**
     * Get the value of chapters
     */ 
    public function getChapters()
    {
        return $this->chapters;
    }

    /**
     * Set the value of chapters
     *
     * @return  self
     */ 
    public function setChapters($chapters)
    {
        $this->chapters = $chapters;

        return $this;
    }
}