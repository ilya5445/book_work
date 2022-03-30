<?php

namespace fb2\src\Models;

use fb2\src\BaseModel;

class TitleInfo extends BaseModel {

    private $title = 'Неизвестное название';
    private $annotation = '';

    public function parse($xml) {

        if ((string)$xml->{'book-title'}) $this->setTitle(trim((string)$xml->{'book-title'}));
        if ((string)$xml->{'annotation'}) $this->setAnnotation(trim(strip_tags((string)$xml->{'annotation'}->children()->asXML())));

        return $this;

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
     * Get the value of annotation
     */ 
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Set the value of annotation
     *
     * @return  self
     */ 
    public function setAnnotation($annotation)
    {
        $this->annotation = $annotation;

        return $this;
    }
}