<?php
$nume="";
if (!empty($_POST["nume"]))
    $nume = trim($_POST["nume"]);
if (!empty($_POST["email"]))
    $email = trim($_POST["email"]);
if (!empty($_POST["mesaj"]))
    $mesaj = trim($_POST["mesaj"]);

$clicked = isset($_POST["clicked"]);
$correct = $nume && $email && $mesaj;

if ($correct) {
    $file = fopen("pareri.txt", "a") or die("Nu a fost gasit fisierul");
    fwrite($file, $nume);
    fwrite($file, ", ");
    fwrite($file, $email);
    fwrite($file, ", ");
    fwrite($file, $mesaj);
    fwrite($file, "\n");
    fclose($file);
}
