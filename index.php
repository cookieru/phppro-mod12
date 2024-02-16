<?php
include_once "vars.php";
include_once "main.php";

foreach (getPartsFromFullname("Сухачев Илья Сергеевич") as $key => $value) {
    echo "<p>$key: $value</p>";
}

$method = 'getFullnameFromParts';
echo "<p>{$method('Сухачев','Илья','Сергеевич')}</p>";



