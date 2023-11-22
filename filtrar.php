<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Páginas</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
body {
    background: linear-gradient(to right, #ff5733 , #ffb1a0
    );
}
.container {
    margin: 20px;
    font-family: 'Times New Roman', Times, serif;
}

.columns {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.column {
    flex: 1 0 80%; /* Aumenté el porcentaje para hacer las columnas más grandes */
    padding: 20px; /* Aumenté el espacio interno para dar más espacio al contenido */
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;

}

.column:hover {
    transform: translateY(-5px);
}

.label {
    font-weight: bold;
    color: #333;
}

.textbox {
    width: 100%;
    padding: 15px; /* Aumenté el espacio interno para dar más espacio al contenido */
    margin-bottom: 15px;
    box-sizing: border-box;
    background-color: #e0e0e0;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-size: 14px; /* Ajusté el tamaño de la fuente */
    font-weight: bold; /* Aplicar negrita */

}

.textbox:focus {
    outline: none;
    background-color: #d5d5d5;
    border: 1px solid #555;
}
            /* Estilo para cada campo (etiqueta y caja de texto) */
            .campo {
                margin-bottom: 10px;
            }
        
            
        
     form#canvasForm {
        max-width: 500px;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    form#canvasForm canvas {
        background-color: #FDFEFE;
        border: 1px solid #000;
        display: block;
        margin: 0 auto;
    }

    form#canvasForm button {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        background-color: #1a5276; /* Color verde */
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    form#canvasForm button:hover {
        background-color: #7fb3d5; /* Cambia el color al pasar el ratón sobre el botón */
    }
    button#btnFirmar {
            position: absolute;
            bottom: 0;
            right: 0;
            margin: 10px;
            padding: 10px;
            background-color: #1a5276;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
    }
     body{background:#FDFEFE;}
     canvas {
  
        background-color: #FDFEFE;
        border: 1px solid #000;
        display:block;
        margin: 0 auto;
    }
    p{
       text-align:center; 
       color:black;
       font-size: xx-large;
    }
    div{
       text-align: center;
    }
        body {
            background: linear-gradient(to right, #ff0000, #00ff00);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .imagen-superior-derecha {
            position: absolute;
            top: 0;
            right: 0;
            width: 260px; /* Ajusta el ancho según tus necesidades */
            height: auto;
            z-index: 1;
        }

        h1 {
            text-align: center;
            padding: 20px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
        }

        button {
            background-color: #1a5276; /* Color verde */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #7fb3d5; /* Cambia el color al pasar el ratón sobre el botón */
        }
        @media screen and (max-width: 600px) {
            .imagen-superior-derecha {
                position: static;
                width: 100%; /* Otra opción: width: auto; */
                max-width: 200px; /* Ajusta según sea necesario */
                margin: 0 auto; /* Centra la imagen */
                z-index: 0;
            }

            h1 {
                text-align: center;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<img src="acsaSinFondo.png" alt="Imagen Superior Derecha" class="imagen-superior-derecha">
    <h1>Selecciona la Sucursal y la Estación</h1>

    <form id="filtroForm">

        <label for="sucursal">Sucursal:</label>
        <select id="sucursal" name="sucursal">
            <?php
            // Conexión a la base de datos
            $servername = "162.241.62.217";
            $username = "superacs_sistemas";
            $password = "Sistemas2021";
            $dbname = "superacs_sistemas";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta para obtener las sucursales
            $sql = "SELECT ID_INTERNO, SUCURSAL FROM sucursal";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["ID_INTERNO"] . "'>" . $row["SUCURSAL"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay sucursales disponibles</option>";
            }

            $conn->close();
            ?>
        </select>

        <label for="estacion">Estación:</label>
        <select id="estacion" name="estacion">
            <?php
            // Conexión a la base de datos
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta para obtener las estaciones
            $sql = "SELECT ID, DESCRIPCION FROM estaciones";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["ID"] . "'>" . $row["DESCRIPCION"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay estaciones disponibles</option>";
            }

            $conn->close();
            ?>
        </select>

        <button type="button" onclick="filtrarDatos()">Filtrar</button>
        <button type="button" onclick="mostrarFormularioCanvas()">Firmar</button>
        </form>
    
        <div id="resultados" class="container"></div>

        <form id="canvasForm" style="display: none;" method="post" action="docEjem.php">
    <input type="hidden" id="sucursalHidden" name="sucursal" value="">
    <input type="hidden" id="firmaImagen" name="firmaImagen" value="">
    <canvas id="canvas" width="350" height="130"></canvas>
    <button id="btnDescargar">Descargar Firma</button>
    <button id="btnLimpiar">Limpiar Firma</button>
    <button id="btnGenerarDocumento">Generar Documento</button>
    </form>
<script>
const $canvas = document.querySelector("#canvas"),
    $btnDescargar = document.querySelector("#btnDescargar"),
    $btnLimpiar = document.querySelector("#btnLimpiar");
    $btnGenerarDocumento = document.querySelector("#btnGenerarDocumento");
    
var ctx = $canvas.getContext("2d");
var cw = ($canvas.width = 350), cx = cw / 2;
var ch = ($canvas.height = 130), cy = ch / 2;
ctx.strokeStyle = "fff";
const COLOR_PINCEL="black";
const COLOR_FONDO = "white";
var dibujando = false;


var m = { x: 0, y: 0 };
const limpiarCanvas = () => {
  // Colocar color blanco en fondo de canvas
  ctx.fillStyle = COLOR_FONDO;
  ctx.fillRect(0, 0, $canvas.width, $canvas.height);
};
limpiarCanvas();
$btnLimpiar.onclick = function (event) {
  limpiarCanvas();
  event.preventDefault(); // Evitar comportamiento por defecto del botón
};
$btnDescargar.onclick = function (event) {
  const enlace = document.createElement('a');
  // El título
  enlace.download = "Firma.png";
  // Convertir la imagen a Base64 y ponerlo en el enlace
  enlace.href = $canvas.toDataURL();
  // Hacer click en él
  enlace.click();
  event.preventDefault(); // Evitar comportamiento por defecto del botón
};

window.obtenerImagen = () => {
  return $canvas.toDataURL();
};

$btnGenerarDocumento.onclick = () => {
    // Al hacer clic en "Generar Documento", envía el formulario con la firma
    document.getElementById("firmaImagen").value = obtenerImagen();
    document.getElementById("canvasForm").submit();
};


var eventsRy = [{event:"mousedown",func:"onStart"}, 
                {event:"touchstart",func:"onStart"},
                {event:"mousemove",func:"onMove"},
                {event:"touchmove",func:"onMove"},
                {event:"mouseup",func:"onEnd"},
                {event:"touchend",func:"onEnd"},
                {event:"mouseout",func:"onEnd"}
               ];

function onStart(evt) {
  m = oMousePos($canvas, evt);
  ctx.beginPath();
  ctx.fillStyle = COLOR_PINCEL;
  dibujando = true;
}

function onMove(evt) {
  if (dibujando) {
    ctx.moveTo(m.x, m.y);
    m = oMousePos($canvas, evt);
    ctx.fillStyle = COLOR_PINCEL;
    ctx.lineTo(m.x, m.y);
    ctx.stroke();
  }
}

function onEnd(evt) {
  dibujando = false;
}

function oMousePos($canvas, evt) {
  var ClientRect = $canvas.getBoundingClientRect();
  var e = evt.touches ? evt.touches[0] : evt;

    return {
      x: Math.round(e.clientX - ClientRect.left),
      y: Math.round(e.clientY - ClientRect.top)
    };
}

for (var i = 0; i < eventsRy.length; i++) {
  (function(i) {
      var e = eventsRy[i].event;
      var f = eventsRy[i].func;console.log(f);
      $canvas.addEventListener(e, function(evt) {
            evt.preventDefault();
            window[f](evt);
            return;
        },false);
  })(i);
}

clear.addEventListener(
  "click",
  function() {
    ctx.clearRect(0, 0, cw, ch);
  },
  false
);
function mostrarFormularioCanvas() {
    // Obtén la sucursal seleccionada
    var sucursalSeleccionada = document.getElementById("sucursal").value;

    // Establece el valor del campo oculto en el formulario del canvas
    document.getElementById("sucursalHidden").value = sucursalSeleccionada;

    // Muestra el formulario con el canvas y los botones
    var canvasForm = document.getElementById("canvasForm");
    canvasForm.style.display = "block";
}
</script>

<script>
function filtrarDatos() {
    var sucursal = document.getElementById("sucursal").value;
    var estacion = document.getElementById("estacion").value;

    // Realiza una petición AJAX para obtener y mostrar los datos
    $.ajax({
        url: "mostrar.php",
        method: "POST",  // Agregué el método POST
        data: { sucursal: sucursal, estacion: estacion },  // Agregué los datos que se enviarán al servidor
        dataType: "html",
        success: function(response) {
           // $("#resultados").html(response);
            //$("#resultados").addClass("container");
            //window.open('resultados.html', '_blank');
            var nuevaPestana = window.open('resultados.html', '_blank');

// Esperar a que la nueva pestaña esté completamente cargada
            nuevaPestana.onload = function() {
    // Insertar los resultados en la nueva pestaña
            nuevaPestana.document.body.innerHTML = response;
};
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
            console.log("Detalles de la respuesta:", jqXHR.responseText);
        }
    });
}
</script>
   
</body>
</html>
