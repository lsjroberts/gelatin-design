<?php namespace Blog\Articles;

use Str;

class Article implements ArticleInterface  {

    public $slug;
    public $date;
    public $title;
    public $view;
    public $tags;

    public function __construct($array)
    {
        foreach ($array as $key => $value)
        {
            $this->$key = $value;
        }

        if (! $this->slug) $this->slug = Str::slug($this->title);
        if (! $this->view) $this->view = $this->date->toDateString();
    }

}