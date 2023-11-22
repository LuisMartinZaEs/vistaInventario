<?php
$servername = "162.241.62.217";
$username = "superacs_sistemas";
$password = "Sistemas2021";
$database = "superacs_sistemas";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Error de conexión a la base de datos");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sucursal = $_POST["sucursal"];
    $estacion = $_POST["estacion"];

    $sql = "SELECT articulos.SERIE_INTERNA, categorias.DESCRIPCION AS CATEGORIAS, sucursal.SUCURSAL, estaciones.DESCRIPCION AS ESTACION, articulos.DESCRIPCION, 
            articulos.MODELO, articulos.CAPACIDAD, articulos.SERIE, articulos.MARCA, articulos.TIPO, articulos.FRECUENCIA, 
            articulos.ACTIVO, articulos.ESTADO, articulos.FOLIO_FACTURA, articulos.PROVEEDOR 
            FROM articulos 
            INNER JOIN categorias ON articulos.CATEGORIA = categorias.ID 
            INNER JOIN sucursal ON articulos.SUCURSAL = sucursal.ID_INTERNO 
            INNER JOIN estaciones ON articulos.ESTACION = estaciones.ID 
            WHERE articulos.SUCURSAL = ? AND articulos.ESTACION = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ss", $sucursal, $estacion);
    mysqli_stmt_execute($stmt);

    $resultados = mysqli_stmt_get_result($stmt);

    if (!$resultados) {
        die("Error en la consulta: " . mysqli_error($conn));
    }

    if ($resultados && mysqli_num_rows($resultados) > 0) {
        $htmlResultados = "<div class='columns'>";
        $camposResaltados = array('SUCURSAL', 'ESTACION', 'SERIE_INTERNA');

        while ($fila = mysqli_fetch_assoc($resultados)) {
            $htmlResultados .= "<div class='column'>";
            foreach ($fila as $campo => $valor) {
                $htmlResultados .= "<div class='campo'>";
                $htmlResultados .= "<label class='label'>$campo:</label>";
                if (in_array($campo, $camposResaltados)) {
                    $htmlResultados .= "<input class='textbox highlight' type='text' value='$valor' readonly><br>";
                } else {
                    $htmlResultados .= "<input class='textbox' type='text' value='$valor' readonly><br>";
                }
                $htmlResultados .= "</div>";
            }
            $htmlResultados .= "</div>"; 
        }
        $htmlResultados .= "</div>";


           // Al final, redirige a la nueva página con los resultados
           echo $htmlResultados;
    exit();
    } else {
        echo "No se encontraron resultados";
    }
} else {
    echo "No se recibieron datos";
}

mysqli_close($conn);
?>
