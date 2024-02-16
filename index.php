<?php
include_once "vars.php";
include_once "main.php";

foreach (getPartsFromFullname("Сухачев Илья Сергеевич") as $key => $value) {
    echo "<p>$key: $value</p>";
}

$method = 'getFullnameFromParts';
echo "<p>{$method('Сухачев','Илья','Сергеевич')}</p>";

$method = 'getShortName';
echo "<p>{$method("Сухачев Илья Сергеевич")}</p>";

$method = 'getGenderFromName';
echo "<p>{$method("Сухачев Илья Сергеевич")}</p>";

echo "<p>";
foreach ($example_persons_array as $person)
{
    echo "{$person["fullname"]} {$method($person["fullname"])}";
    echo "<br>";
}
echo "</p>";

$method = 'getGenderDescription';
echo "<p>{$method($example_persons_array)}</p>";