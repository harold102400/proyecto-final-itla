<?php
include "./local_libreria.php";
$pretamoInfo = new Prestamo();
$result_clientes = $pretamoInfo->getClientes();
$result_libros = $pretamoInfo->getLibros();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="./styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php include "./nav.php" ?>

    <div class="container">
        <form action="procesar_prestamo.php" method="POST" class="form-libreria">

        <div class="form-group">    
        <label for="id_cliente">Cliente:</label>
            <select id="id_cliente" name="id_cliente" required class="form-select">
                <option value="">Seleccione un cliente</option>
                <?php
                if ($result_clientes->columnCount() > 0) {
                    while ($row_cliente = $result_clientes->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row_cliente['id_cliente'] . "'>" . "id: " . $row_cliente['id_cliente'] . " " . "nombre: " .  $row_cliente['nombre'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay clientes disponibles</option>";
                }
                ?>
            </select>
        </div>
            <div class="form-group">
            <label for="id_libro">Libro:</label>
            <select id="id_libro" name="id_libro" required class="form-select">
                <option value="">Seleccione un libro</option>
                <?php
                if ($result_libros->columnCount() > 0) {
                    while ($row_libro = $result_libros->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row_libro['id_libro'] . "'>" . $row_libro['titulo'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay libros disponibles</option>";
                }
                ?>
            </select>
            </div>

            <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>
            </div>

            <div class="form-group">
            <label for="fecha_final">Fecha de Final:</label>
            <input type="date" id="fecha_final" name="fecha_final" required>
            </div>

            <input type="submit" value="Agregar Préstamo" class="btn btn-success">
        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

