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

function getShortName($fullName)
{
    $names = getPartsFromFullname($fullName);
    $result = $names['name'] . " ";
    $result .= mb_substr($names['surname'], 0, 1) . ".";

    return $result;
}

$GENDER_TAGS = [
    ['female' => ['ва'], 'male' => ['в']],
    ['female' => ['а'], 'male' => ['й', 'н']],
    ['female' => ['вна'], 'male' => ['ич']]
];
$GENDER_TAGS = array_combine($NAMES_KEYS, $GENDER_TAGS);

function getGenderFromName($fullName)
{
    $names = getPartsFromFullname($fullName);
    $gender_value = 0;

    foreach ($names as $key => $name) {
        foreach ($GLOBALS['GENDER_TAGS'][$key]['female'] as $tag) {
            if (mb_substr($name, mb_strlen($name) - mb_strlen($tag), mb_strlen($tag)) === $tag)
                $gender_value -= 1;
        }
        foreach ($GLOBALS['GENDER_TAGS'][$key]['male'] as $tag) {
            if (mb_substr($name, mb_strlen($name) - mb_strlen($tag), mb_strlen($tag)) === $tag)
                $gender_value += 1;
        }
    }

    return $gender_value <=> 0;
}
