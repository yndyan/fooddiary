<?php

require_once APPPATH.'models/MY_Model.php';
class Meals_diary extends MY_Model
{
    CONST table_name = 'meals_diary';

    function getTableName()
    {
        return self::table_name;
    }
} 