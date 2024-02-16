<?php
$NAMES_KEYS = ['surname', 'name', 'patronomyc'];

function getPartsFromFullname($fullName)
{
    $names = explode(' ', $fullName, 3);
    return array_combine($GLOBALS['NAMES_KEYS'], $names);
}

function getFullnameFromParts($surname, $name, $patronomyc)
{
    $result = $surname . ' ';
    $result .= $name . ' ';
    $result .= $patronomyc;

    return $result;
}
