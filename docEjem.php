
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENTREGA DE INVENTARIO</title>
    <style>
        .titulo {
            text-align: center;
        }
        .alinear-derecha{
            float:right;
        }
        .h2 {
            text-align: center;
        }

        .justificado {
            text-align: justify;
        }

        .alinear-derecha {
            float: right;
        }

        .firma {
            text-align: left;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto; /* Centra la tabla y agrega un margen */
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd; /* Añade bordes a las celdas */
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .logo {
            float: right;
            margin: 15px; /* Puedes ajustar el margen según tus preferencias */
        }
    </style>
</head>

<body>
<img src="acsalogo.png" class="alinear-derecha logo"> <!-- Agregado el estilo 'logo' a la imagen del logo -->
<h1 class = "titulo">REPORTE DE INVENTARIO</h1>
    <br>
    <br>
    <br>
    <p class="justificado">Por medio del presente documento permítame saludarle, a su vez,
        hacer constar la entrega de inventario de equipos de cómputo (Hardware)
        generado por el compañero: <strong>LUIS MARTÍN ZAVALA ESPINOZA</strong>,
        por parte del área de sistemas, dando fe a los equipos activos de la
        sucursal. Previo al inventario, se concluye que la oficina cuenta con:</p>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sucursal = $_POST["sucursal"];

    // Conexión a la base de datos (ajusta según tu configuración)
    $servername = "162.241.62.217";
    $username = "superacs_sistemas";
    $password = "Sistemas2021";
    $dbname = "superacs_sistemas";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    } else {
        // Consulta SQL usando el valor de la sucursal obtenido
        $sql = "SELECT sucursal.SUCURSAL,categorias.DESCRIPCION, COUNT(*) AS EXISTENCIAS 
                FROM articulos 
                INNER JOIN categorias ON articulos.CATEGORIA=categorias.ID 
                INNER JOIN sucursal ON articulos.SUCURSAL=sucursal.ID_INTERNO
                WHERE articulos.SUCURSAL = ? 
                GROUP BY CATEGORIA";

        $stmt = $conn->prepare($sql);

        // Verificar si hay errores en la preparación de la consulta
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt->bind_param("s", $sucursal);
        $stmt->execute();

        // Verificar si hay errores en la ejecución de la consulta
        if ($stmt->errno) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }

        $result = $stmt->get_result();

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<thead><tr><th>Categoría</th><th>Total</th></tr></thead><tbody>";

            // Imprimir los resultados
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["DESCRIPCION"] . "</td><td>" . $row["EXISTENCIAS"] . "</td></tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "No se encontraron resultados. La consulta podría no estar devolviendo filas.";
        }

        // Cerrar la conexión
        $conn->close();
    }
} else {
    echo "No se han recibido datos del formulario.";
}
?>
<p class="justificado">Al momento de recibir el equipo especificado, se realizaron pruebas para avalar el funcionamiento 
                       de cada uno de los equipos, para que dicha oficina siga trabajando de manera adecuada.</p>

<h2 class="h2">RECIBE: </h2>
    
<img src="<?php echo $_POST['firmaImagen']; ?>" alt="Firma del usuario" class="firma">
 <br>
 
  <script>
        if (window.opener) {
            document.querySelector(".firma").src = window.opener.obtenerImagen();
            // Imprimir documento. Si no quieres imprimir, remueve la siguiente línea
            window.print();
        }
    </script>
</body>

</html>
