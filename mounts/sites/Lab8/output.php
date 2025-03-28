<?php
$file = fopen("pareri.txt", "r") or die("Nu a fost gasit fisierul!");
$lineNr = 0;
while (!feof($file)) {
    $lineNr++;
    $class = $lineNr % 2 == 0 ? "greenyellowB" : "redB";
    $line = explode(",", trim(fgets($file)));
    if ($line[0] == "") break;
    echo "
    <div class=\"$class\">
        $line[0], $line[2]
    </div>";
}
