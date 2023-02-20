<?php
try {
    $dbname="asincronia";
    $user="nataly";
    $password="1234";
    $dsn = "mysql:host=localhost;dbname=$dbname";
    
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $dbh = new PDO($dsn, $user, $password);

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "\n";
    die();
}

if(isset($_POST['insertar'])) {
    $stmt = $dbh->prepare("INSERT INTO usuarios (nombre, apellidos, dni, estudios)
    VALUES (:nombre, :apellidos, :dni, :estudios)");
    
    //Aqui mete los datos
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $estudios = $_POST['estudios'];
    
    //Aqui ejecutas para pegar los valores en la sentencia
    if ($stmt->execute([
        ':nombre'=>$nombre,
        ':apellidos'=>$apellidos,
        ':dni'=>$dni,
        ':estudios'=>$estudios,
        ])) {
        echo 'Insercción realizada!!!!!';
    } else {
        echo 'Insercción fallida :(';
    }
}

if(isset($_POST['borrar'])) {
    $stmt = $dbh->prepare("DELETE FROM usuarios WHERE dni = :dni");
    
    //Aqui mete los datos
    $dni = $_POST['dni'];
    
    //Aqui ejecutas para pegar los valores en la sentencia
    if ($stmt->execute([
        ':dni'=>$dni
        ])) {
        echo 'Borrado realizado!!!!!';
    } else {
        echo 'Borrado fallido :(';
    }
}
