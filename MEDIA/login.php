<?php
session_start();
require 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo=?");
    $stmt->execute([$correo]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($contrasena, $user['contrasena'])){
        $_SESSION['logged'] = true;
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['rol'] = $user['rol'];
        echo "<script>alert('✅ Bienvenido {$user['nombre']}'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('❌ Usuario o contraseña incorrectos'); window.history.back();</script>";
    }
}
?>
