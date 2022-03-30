<?php

namespace fb2\src\Models;

use fb2\src\BaseModel;
use fb2\src\Models\Chapter;

class Chapters extends BaseModel {

    private $chapters = [];

    public function parse($xml) {

        foreach ($xml as $key => $chapter) {
            $this->chapters[] = (new Chapter)->parse($chapter);
        }

        return $this->chapters;

    }

}