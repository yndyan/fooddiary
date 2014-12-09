<?php


class Meals_diary extends BaseModel
{
    CONST table_name = 'meals_diary';

    function getTableName()
    {
        return self::table_name;
    }
} 