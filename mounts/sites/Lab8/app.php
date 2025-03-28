<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pareri</title>
    <link rel="stylesheet" href="CSS/form.css">
    <link rel="stylesheet" href="CSS/app.css">
</head>

<body>
    <?php
    require "HTML/form.html";
    require "index.php";
    ?>
    <?php
    if (!$correct && $clicked) {
        echo "<p>Introduceti toate campurile</p>";
    }
    ?>
    <div class="pareri">
        <h2>Recenziile clientilor nostri!</h2>
        <?php include "output.php" ?>
    </div>
</body>

</html>