<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar cliente</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <LINK href="./styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php include "./nav.php" ?>
    <div class="container">
        <?php
        include "./local_libreria.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cliente = new Cliente();
            $cliente->crearCliente();
        }
        ?>
        <form action="agregar_cliente.php" method="post" class="form-libreria">
            <div class="form-group">
                <label>Nombre: </label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label>Telefono: </label>
                <input type="number" id="telefono" name="telefono" required>
            </div>
            <input type="submit" value="Registrar" class="btn btn-success">
        </form>
    </div>
</body>

</html>