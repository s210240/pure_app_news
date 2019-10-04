<?php

/**
 * Class Model
 */
class Model
{
    public $connection;
    public $table;

    public function __construct()
    {
        $this->connection = new mysqli("localhost", "root", "roman12roman", "pure_news");
    }

}