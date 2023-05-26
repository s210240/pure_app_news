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
        $this->connection = new mysqli("localhost", "root", "password", "pure_news");
    }

}