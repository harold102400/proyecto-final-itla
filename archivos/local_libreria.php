<?php
include "./conexion_db.php";

class Cliente
{
    private $nombre;
    private $numero_telefono;
    private $db;
    public function __construct()
    {
        $this->db = ConexionDb::getInstance()->getConnection();
    }

    public function crearCliente()
    {

        $this->nombre = $_POST['nombre'];
        $this->numero_telefono = $_POST['telefono'];

        $sql = "INSERT INTO clientes (nombre, numero_telefono) VALUES (:nombre, :numero_telefono)";
        $result = $this->db->prepare($sql);
        if ($result) {
            $result->execute([
                ":nombre" => $this->nombre,
                ":numero_telefono" => $this->numero_telefono
            ]);
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Nuevo cliente registrado con exito!</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
            $this->db = null;
        }
    }

    public function getClientes()
    {
        $sql = "SELECT * FROM clientes";
        $result = $this->db->query($sql);
        $Alldata = $result->fetchAll(PDO::FETCH_ASSOC);
        return $Alldata;
    }
}

class Prestamo
{
    private $id_cliente;
    private $id_libro;
    private $fecha_inicio;
    private $fecha_final;
    private $db;
    public function __construct()
    {
        $this->db = ConexionDb::getInstance()->getConnection();
    }

    public function procesarPrestamo()
    {

        $this->id_cliente = $_POST['id_cliente'];
        $this->id_libro = $_POST['id_libro'];
        $this->fecha_inicio = $_POST['fecha_inicio'];
        $this->fecha_final = $_POST['fecha_final'];

        if (!empty($this->id_cliente) && !empty($this->id_libro) && !empty($this->fecha_inicio) && !empty($this->fecha_final)) {
            $sql_query = "SELECT COUNT(*) 
            FROM prestamos 
            WHERE id_cliente = :id_cliente
            AND fecha_final < NOW() 
            AND id_prestamo NOT IN (SELECT id_prestamo FROM devoluciones)";
            $stmt = $this->db->prepare($sql_query);
            $stmt->execute([":id_cliente" => $this->id_cliente]);
            $prestamos_vencidos = $stmt->fetchColumn();

            if ($prestamos_vencidos > 0) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>No puede realizar un nuevo préstamo. Tiene préstamos vencidos pendientes de devolución.</strong>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
            } else {
                $sql = "SELECT estado FROM libros WHERE id_libro = :id_libro";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([":id_libro" => $this->id_libro]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($data["estado"] === 'disponible') {
                    $sql = "INSERT INTO prestamos (id_cliente, id_libro, fecha_inicio, fecha_final)
                           VALUES (:id_cliente, :id_libro, :fecha_inicio, :fecha_final)";
                    $stm = $this->db->prepare($sql);
                    $isExecutated = $stm->execute([
                        ":id_cliente" => $this->id_cliente,
                        ":id_libro" => $this->id_libro,
                        ":fecha_inicio" => $this->fecha_inicio,
                        ":fecha_final" => $this->fecha_final
                    ]);

                    if ($isExecutated) {
                        $sql = "UPDATE libros SET estado = 'prestado' WHERE id_libro = :id_libro";
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute([":id_libro" => $this->id_libro]);
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Préstamo agregado correctamente. El libro ha sido marcado como prestado.</strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                            </div>";
                    } else {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                             <strong>Error al agregar el préstamo: " . $stm->error . "</strong>
                             <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                             </button>
                             </div>";
                    }
                } else {
                   echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>El libro seleccionado ya está prestado y no está disponible.</strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                            </div>";
                }
            }
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                  <strong>Todos los campos son obligatorios.</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                  </div>";
        }
    }

    public function getLibros()
    {
        $sql_libros = "SELECT id_libro, titulo FROM libros";
        $result_libros = $this->db->query($sql_libros);
        return $result_libros;
    }
    public function getClientes()
    {
        $sql_clientes = "SELECT id_cliente, nombre FROM clientes";
        $result_clientes = $this->db->query($sql_clientes);
        return $result_clientes;
    }
}

class Libro
{
    private $titulo;
    private $author;
    private $isbn;
    private $numero_edicion;
    private $costo_diario;
    private $db;
    public function __construct()
    {
        $this->db = ConexionDb::getInstance()->getConnection();
    }

    public function registrarLibro()
    {
        $this->titulo = $_POST['titulo'];
        $this->author = $_POST['author'];
        $this->isbn = $_POST['isbn'];
        $this->numero_edicion = $_POST['numero_edicion'];
        $this->costo_diario = $_POST['costo_diario'];


        $sql = "INSERT INTO libros (titulo, author, ISBN, numero_edicion, costo_diario) VALUES (:titulo, :author, :isbn, :numero_edicion, :costo_diario)";
        $result = $this->db->prepare($sql);
        if ($result) {
            $result->execute([
                ":titulo" => $this->titulo,
                ":author" => $this->author,
                ":isbn" => $this->isbn,
                ":numero_edicion" => $this->numero_edicion,
                ":costo_diario" => $this->costo_diario
            ]);
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Nuevo libro registrado con exito!</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
            $this->db = null;
        }
    }

    public function getLibros()
    {
        $sql = "SELECT * FROM libros";
        $result = $this->db->query($sql);
        $Alldata = $result->fetchAll(PDO::FETCH_ASSOC);
        return $Alldata;
    }
}

class Devolucion
{
    private $id_prestamo;
    private $fecha_devolucion;
    private $mora;
    private $db;
    public function __construct()
    {
        $this->db = ConexionDb::getInstance()->getConnection();
    }

    public function devolverLibro()
    {

        $this->id_prestamo = $_POST['id_prestamo'];

        if (!empty($this->id_prestamo)) {
            $sql = "SELECT id_libro, fecha_final FROM prestamos WHERE id_prestamo = :id_prestamo";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":id_prestamo" => $this->id_prestamo]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);


            $this->fecha_devolucion = date("Y-m-d");
            $this->mora = 0;
            $diff_dias = 0;
            $fecha_final_obj = new DateTime($data['fecha_final']);
            $fecha_devolucion_obj = new DateTime($this->fecha_devolucion);

            if ($fecha_devolucion_obj > $fecha_final_obj) {
                $diff = $fecha_final_obj->diff($fecha_devolucion_obj);
                $diff_dias = $diff->days;
                $this->mora = $diff_dias * 5;
            }

            $sql = "INSERT INTO devoluciones (id_prestamo, fecha_devolucion, mora) VALUES (:id_prestamo, :fecha_devolucion, :mora)";
            $stmt = $this->db->prepare($sql);
            $isExecutated = $stmt->execute([
                ":id_prestamo" => $this->id_prestamo,
                ":fecha_devolucion" => $this->fecha_devolucion,
                ":mora" => $this->mora
            ]);

            if ($isExecutated) {
                $sql = "UPDATE libros SET estado = 'disponible' WHERE id_libro = :id_libro";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ":id_libro" => $data['id_libro']
                ]);

                $sql = "UPDATE prestamos SET fecha_final = :fecha_final, estado_prestamo = 'finalizado' WHERE id_prestamo = :id_prestamo";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ":fecha_final" => $this->fecha_devolucion,
                    ":id_prestamo" => $this->id_prestamo
                ]);
                echo "<div class='mini-container'>
              <p class='title'>Libro devuelto correctamente</p>
              <p  class='title'>Días de atraso: " . $diff_dias . "</p>
              <p  class='title'>Mora calculada: " . $this->mora . ".</p>
              <p  class='title'>Libro marcado como disponible." . "</p>
              </div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error al registrar la devolución: " . $stmt->error ."</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
            }
        } else {
            echo "Debe seleccionar un préstamo para devolver.";
        }

        $this->db = null;
    }

    public function getEstadoPrestamo()
    {
        $query_sql = "SELECT P.id_prestamo, L.titulo 
                  FROM prestamos AS P
                  JOIN libros AS L ON P.id_libro = L.id_libro
                  WHERE L.estado = 'prestado'
                  AND P.estado_prestamo = 'activo'";
        $data = $this->db->query($query_sql);
        return $data;
    }
}
