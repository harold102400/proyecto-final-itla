<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registart libro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="./styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php include "./nav.php" ?>
    <div class="container">
    <?php
    include "./local_libreria.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $libro = new Libro();
        $libro->registrarLibro();
    }
    ?>
        <form action="agregar_libro.php" method="post" class="form-libreria">
            <div class="form-group">
                <label>Titulo: </label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label>Author: </label>
                <input type="text" id="author" name="author" required>
            </div>

            <div class="form-group">
                <label>ISBN: </label>
                <input type="number" id="isbn" name="isbn" required>
            </div>

            <div class="form-group">
                <label>Numero de numero edicion: </label>
                <input type="number" id="numero_edicion" step="0.01" name="numero_edicion" required>
            </div>
            <div class="form-group">
                <label>Costo diario: </label>
                <input type="number" id="costo_diario" name="costo_diario" required>
            </div>
            <input type="submit" value="Registrar" class="btn btn-success">
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>