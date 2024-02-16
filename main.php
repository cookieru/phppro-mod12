<?php 
    $NAMES_KEYS = ['surname', 'name', 'patronomyc'];

    function getPartsFromFullname($fullName)
    {
        $names = explode(' ', $fullName, 3);
        return array_combine($GLOBALS['NAMES_KEYS'], $names);
    }