<?php namespace Blog\Tags;

class Tag implements TagInterface {

    public function __construct($array)
    {
        foreach ($array as $key => $value)
        {
            $this->$key = $value;
        }
    }

}