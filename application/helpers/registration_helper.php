<?php

    function Generate_random_string($result_length)
    {
        if($result_length > 0)
        {
            $Generated_string = '';
            $String_array = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $String_length = strlen($String_array);

            for($i=0;$i<$result_length;$i++)
            {
                $Generated_string = $Generated_string.$String_array[rand(0,$String_length-1)];
            }

            return $Generated_string;
        }
        else
        {
            return false;
        }



    }



   //helper koji ispisuje poruke i onda brise istu u sesiji