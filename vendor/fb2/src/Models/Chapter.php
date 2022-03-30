<?php

namespace fb2\src\Models;

use fb2\src\BaseModel;

class Chapter extends BaseModel {

    private $title = 'Неизвестное название';
    private $content;

    public function parse($chapter) {

        if ($chapter->title) {
            $this->setTitle(trim(strip_tags($chapter->title->children()->asXML())));
            unset($chapter->title);
        }

        if ($chapter) {
            $this->setContent(trim($this->removeHTML($chapter->asXML())));
        }

        return $this;

    }

    public function removeHTML($str) {
        return str_replace([
            '<section>', '</section>', '<empty-line></empty-line>', '<empty-line/>', '<emphasis>', '</emphasis>'], 
            ['', '', '<br/>', '<br/>', '<i>', '</i>'], 
            $str
        );
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}