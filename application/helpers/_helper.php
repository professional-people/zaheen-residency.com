<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//--------------- Defining Custom Functions ---------------

    function only_numbers($number)
    {

        $nbr = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
        $clean = str_replace('-', '', $nbr);
        return $clean;
    }
?>