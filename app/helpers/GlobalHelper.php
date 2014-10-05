<?php

class GlobalHelper {

    /**
     * Spit the array into a human readable format. 
     * Also can send an argument to stop exection of script 
     * after showing the data.
     * @return array
     */
    public static function dsm($var, $flag = 0)
    {
        print '<pre>';
        print_r($var);
        print '</pre>';

        if ($flag === 1) {
            exit();
        }
    }

}