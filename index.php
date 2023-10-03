<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Formulario de Contacto</title>
</head>
<body>
    <h2>Formulario de Contacto</h2>
    <form action="index.php" method="post">
        <label for="nombre">Nombre y Apellidos:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>

        <label for="ocupacion">Ocupación:</label>
        <input type="text" id="ocupacion" name="ocupacion" required><br><br>

        <label for="contacto">Contacto (teléfono, email):</label>
        <input type="text" id="contacto" name="contacto" required><br><br>

        <label for="nacionalidad">Nacionalidad:</label>
        <select id="nacionalidad" name="nacionalidad">
            <option value="seleccionar">Seleccionar</option>
            <option value="Peruana">Peruana</option>
            <option value="Argentina">Argentina</option>
            <option value="Chilena">Chilena</option>
            <option value="Boliviana">Boliviana</option>
            <option value="Estadounidense">Estadounidense</option>
            <option value="Mexicana">Mexicana</option>
            <option value="Espoñola">Espoñola</option>
            <option value="Italiana">Italiana</option>
            <option value="japonesa">japonesa</option>

        </select><br><br>

        <label>Nivel de inglés:</label><br>
        <input type="radio" id="basico" name="ingles" value="basico">
        <label for="basico">Básico</label><br>
        <input type="radio" id="intermedio" name="ingles" value="intermedio">
        <label for="intermedio">Intermedio</label><br>
        <input type="radio" id="avanzado" name="ingles" value="avanzado">
        <label for="avanzado">Avanzado</label><br>
        <input type="radio" id="fluido" name="ingles" value="fluido">
        <label for="fluido">Fluido</label><br><br>

        <label for="lenguajes">Lenguajes de programación:</label>
        <select id="lenguajes" name="lenguajes[]" multiple>
            <option value="java">Java</option>
            <option value="python">Python</option>
            <option value="javascript">JavaScript</option>
            <option value="csharp">C#</option>
            <option value="c++">C++</option>
            <option value="PHP">PHP</option> 
        </select><br><br>

        <label for="aptitudes">Aptitudes:</label>
        <input list="aptitudes" name="aptitudes">
        <datalist id="aptitudes">
            <option value="Trabajo en equipo">
            <option value="Comunicación">
            <option value="Resolución de problemas">
            <!-- Agrega más aptitudes según sea necesario -->
        </datalist><br><br>

        <label>Habilidades:</label><br>
        <input type="checkbox" id="habilidad1" name="habilidades[]" value="habilidad1">
        <label for="habilidad1">Sentido crítico</label><br>
        <input type="checkbox" id="habilidad2" name="habilidades[]" value="habilidad2">
        <label for="habilidad2">Liderazgo</label><br>
        <input type="checkbox" id="habilidad3" name="habilidades[]" value="habilidad3">
        <label for="habilidad3">Creatividad</label><br>
        <input type="checkbox" id="habilidad4" name="habilidades[]" value="habilidad">
        <label for="habilidad">Iniciativa y aprendizaje activo</label><br><br>

        <label for="perfil">Perfil:</label><br>
        <textarea id="perfil" name="perfil" rows="4"></textarea><br><br>

        <input type="submit" value="Enviar">
    </form>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $nombre = $_POST["nombre"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $ocupacion = $_POST["ocupacion"];
    $contacto = $_POST["contacto"];
    $nacionalidad = $_POST["nacionalidad"];
    $ingles = $_POST["ingles"];
    $lenguajes = implode(', ', $_POST["lenguajes"]); // Convierte el array en una cadena
    $aptitudes = $_POST["aptitudes"];
    $habilidades = implode(', ', $_POST["habilidades"]); // Convierte el array en una cadena
    $perfil = $_POST["perfil"];

    // Realiza la conexión a la base de datos (reemplaza estos valores con los tuyos)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "trabajo1";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    
    // Escapa los valores para prevenir inyección SQL (mejora la seguridad)
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $fecha_nacimiento);
    $ocupacion = mysqli_real_escape_string($conn, $ocupacion);
    $contacto = mysqli_real_escape_string($conn, $contacto);
    $nacionalidad = mysqli_real_escape_string($conn, $nacionalidad);
    $ingles = mysqli_real_escape_string($conn, $ingles);
    $lenguajes = mysqli_real_escape_string($conn, $lenguajes);
    $aptitudes = mysqli_real_escape_string($conn, $aptitudes);
    $habilidades = mysqli_real_escape_string($conn, $habilidades);
    $perfil = mysqli_real_escape_string($conn, $perfil);

    // Crea una consulta SQL INSERT para insertar los datos en la tabla 'formulario'
    $sql = "INSERT INTO formulario (`nombre y apellido`, fecha, ocupacion, contacto, nacionalidad, `nivel de ingles`, `lenguaje de programacion`, actitudes, habilidades, perfil) 
            VALUES ('$nombre','$fecha_nacimiento','$ocupacion','$contacto','$nacionalidad','$ingles','$lenguajes','$aptitudes','$habilidades','$perfil')";

    if ($conn->query($sql) === TRUE) {
        // La inserción fue exitosa
        echo "<h3 class='ok'>Te has inscrito correctamente</h3>";
    } else {
        // Ocurrió un error durante la inserción
        echo "<h3 class='bad'>Error: " . $conn->error . "</h3>";
    }

    // Cierra la conexión
    $conn->close();
}
?>
</body>
</html>

