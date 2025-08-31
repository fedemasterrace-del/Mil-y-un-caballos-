<?php
session_start();
require 'db.php';

if(!isset($_SESSION['logged'])){
    echo "<script>alert('❌ Debes iniciar sesión para reservar una cita'); window.location='index.php';</script>";
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];

    $stmt = $pdo->prepare("INSERT INTO citas (nombre, correo, servicio, fecha) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $correo, $servicio, $fecha]);

    echo "<script>alert('✅ Tu cita fue reservada'); window.location='index.php';</script>";
}
?>
