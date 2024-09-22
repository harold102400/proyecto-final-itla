<?php
include "./local_libreria.php";
$sql_prestamos = new Devolucion();
$result_prestamos = $sql_prestamos->getEstadoPrestamo();
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
        <form action="procesar_devolucion.php" method="POST" class="form-libreria">
            <div class="form-group">
                <label for="id_prestamo">Préstamo:</label>
                <select id="id_prestamo" name="id_prestamo" required class="form-select">
                    <option value="">Seleccione un préstamo</option>
                    <?php
                    if ($result_prestamos->columnCount() > 0) {
                        while ($row_prestamo = $result_prestamos->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row_prestamo['id_prestamo'] . "'>" . $row_prestamo['titulo'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay préstamos activos</option>";
                    }
                    ?>

                </select>
            </div>
            <input type="submit" value="Devolver Libro" class="btn btn-success">
        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>