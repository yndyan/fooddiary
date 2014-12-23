<?php
require_once APPPATH.'models/MY_Model.php';

class Intake_reasons extends MY_Model
{
    CONST table_name = 'intake_reasons';

    function getTableName()
    {
        return self::table_name;
    }
    

} 