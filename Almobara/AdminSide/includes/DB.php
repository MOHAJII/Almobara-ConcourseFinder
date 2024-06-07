<?php
try {
    $bd = new PDO('mysql:host=localhost;dbname=gestion_concours','root','');
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Échec de la connexion : " . $e->getMessage());
}