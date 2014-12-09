<?php

class Intake_reasons extends BaseModel
{
    CONST table_name = 'intake_reason';

    function getTableName()
    {
        return self::table_name;
    }
} 