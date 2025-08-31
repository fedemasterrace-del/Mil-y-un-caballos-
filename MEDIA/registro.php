<?php
require 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    // Verificar si el correo ya existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo=?");
    $stmt->execute([$correo]);
    if($stmt->rowCount() > 0){
        echo "<script>alert('❌ Este correo ya está registrado');window.history.back();</script>";
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, contrasena, rol) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $correo, $contrasena, $rol]);

    echo "<script>alert('✅ Registro exitoso'); window.location='index.php';</script>";
}
?>
