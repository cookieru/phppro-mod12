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
    $genderValue = 0;

    foreach ($names as $key => $name) {
        foreach ($GLOBALS['GENDER_TAGS'][$key]['female'] as $tag) {
            if (mb_substr($name, mb_strlen($name) - mb_strlen($tag), mb_strlen($tag)) === $tag)
                $genderValue -= 1;
        }
        foreach ($GLOBALS['GENDER_TAGS'][$key]['male'] as $tag) {
            if (mb_substr($name, mb_strlen($name) - mb_strlen($tag), mb_strlen($tag)) === $tag)
                $genderValue += 1;
        }
    }

    return $genderValue <=> 0;
}

function getGenderDescription($personsArray)
{
    $womenCount = 0;
    $menCount = 0;
    $unknowsCount = 0;
    $total = 0;

    foreach ($personsArray as $person) {
        switch (getGenderFromName($person['fullname'])) {
            case -1:
                $womenCount++;
                break;

            case 1:
                $menCount++;
                break;

            default:
                $unknowsCount++;
                break;
        }
        $total++;
    }

    $number_format = "number_format";

    return <<< RESULT
<pre><span style="font-weight: bold">Гендерный состав аудитории:
---------------------------</span>
Мужчины - {$number_format($menCount / $total * 100, 1)}%
Женщины - {$number_format($womenCount / $total * 100, 1)}%
Не удалось определить - {$number_format($unknowsCount / $total * 100, 1)}%
</pre>
RESULT;
}
