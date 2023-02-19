<?php

// conexion a la base de datos
$conn = new PDO('mysql:dbname=repaso;host=localhost', 'nataly', '1234', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// indicacion del contenido en formato json
header('Content-Type: application/json');

$stmt = $conn->prepare("SELECT * FROM users");

$stmt->execute();

$users = $stmt->fetchAll();

$error = false;
// si es insertar comprobamos que los datos no estan vacios para asi poder guardarlos en la base de datos
if (isset($_POST['enviar'])) {

    if (empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['dni']) || empty($_POST['estudios'])) {
        $error = true;
    }

    if (!$error) {
        $stmt = $conn->prepare("INSERT INTO users (nombre, apellidos, dni, estudios) VALUES (:nombre, :apellidos, :dni, :estudios)");

        // echo "hola";

        $stmt->bindValue(':nombre', $_POST['nombre']);
        $stmt->bindValue(':apellidos', $_POST['apellidos']);
        $stmt->bindValue(':dni', $_POST['dni']);
        $stmt->bindValue(':estudios', implode(',', $_POST['estudios']));

        try {
            //code...
            $stmt->execute();
        } catch (PDOException $e) {
            // error
        }

        // $users = $stmt->fetch();
    }
}

// para borrar el usuario simplemente ejecutamos el delete y se captura el error si lo hubiera pero no se informa de nada
// ya que es informacion extra al usuarios sobre la base de datos
if (isset($_POST['borrar'])) {

    if (empty($_POST['dni'])) {
        $error = true;
    }

    if (!$error) {
        $stmt = $conn->prepare("DELETE FROM users WHERE dni = :dni");

        $stmt->bindValue(':dni', $_POST['dni']);

        try {
            //code...
            $stmt->execute();
        } catch (PDOException $e) {
            // error
        }
    }
}

// devolvemos todos los usuarios en formatos json para luego recuperarlo desde js
echo json_encode($users);