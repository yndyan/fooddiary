<?php

require_once APPPATH.'models/MY_Model.php';

class Food_types extends MY_Model
{
    CONST table_name = 'food_types';

    function getTableName()
    {
        return self::table_name;
    }


} 