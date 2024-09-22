<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="./styles.css" rel="stylesheet" type="text/css" />
    <title>Proceso devolver libro</title>
</head>

<body>
    <div class="container">
        <?php
        include "./nav.php";
        include "./local_libreria.php";

        $devolverPrestamo = new Devolucion();
        $devolverPrestamo->devolverLibro();
        ?>

    </div>

</body>

</html>