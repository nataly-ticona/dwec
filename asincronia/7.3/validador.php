<?php
// conexion a la base de datos
$conn = new PDO('mysql:dbname=repaso;host=localhost', 'nataly', '1234', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// tipo de contenido que es: formato json
header('Content-Type: application/json');

// consulta todos los datos de la base de datos
$db = $conn->prepare("SELECT * FROM users");
$db->execute();
// almacenamos los datos en una variable
$users = $db->fetchAll();
// FORMULARIO DE ENVIAR DATOS
$error=false;
    // si ha dado al boton de enviar
    if (isset($_POST['enviar'])) {
        // si alguno de los campos del formulario esta vacio habra error
        if (empty($_POST['nombre']) ||  empty($_POST['apellido']) || empty($_POST['dni']) || empty($_POST['estudio'])) {
            $error=true;
        }
        // validacion de que sea uno de estos tres
        if ($_POST['estudio']!='DAW' || $_POST['estudio']!='DAM' || $_POST['estudio']!='ASIR' ) {
            $error=true;
        }
        // si no hay errores
        if ($error == false) {
            try {
                // hacemos el insert en la base de datos
                $db = $conn->prepare("INSERT INTO users (nombre, apellidos, dni, estudios) VALUES (:nombre, :apellidos, :dni, :estudios)");
                $db->execute([':name' => $_POST['nombre'],':apellidos' => $_POST['apellido'],':dni' => $_POST['dni'],':estudios', $_POST['estudios']]);
            } catch (PDOException $e) {
            }
            echo 'Se ha registrado el usuario!';
        }
    }
// FORMULARIO DE BORRAR DATOS
$error2=false;  
    // si ha dado al boton de enviar
    if (isset($_POST['borrar'])) {
        // si el dni esta vacio error = true
        if (empty($_POST['dni'])) {
            $error2 = true;
        }
        // si no hay errores
        if ($error2==false) {
            try {
                // hacemos el delete en la base de datos
                $db = $conn->prepare("DELETE FROM users WHERE dni = :dni");
                $db->execute([':dni', $_POST['dni']]);
            } catch (PDOException $e) {
            }
        }
    }
   echo json_encode($users);
    
?>