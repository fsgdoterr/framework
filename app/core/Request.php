<?php
namespace App\Core;


class Request
{
    public function __construct($post)
    {
        foreach($post as $key => $value)
        {
            $this->{$key} = $value;
        }
    }
}