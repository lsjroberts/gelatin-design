<?php namespace Blog\Articles;

class Article implements ArticleInterface  {

    public function __construct($array)
    {
        foreach ($array as $key => $value)
        {
            $this->$key = $value;
        }
    }

}