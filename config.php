<?php
session_start();

// Constantes du site
define('SITE_NAME', 'Dr. Dejolie Christelle');
define('SITE_TITLE', 'Docteur en Cybersécurité | Chercheur & Consultant');
define('BASE_URL', 'http://localhost/Dr%20Christelle/');
define('CURRENT_YEAR', date('Y'));

// Connexion BDD
$host     = 'localhost';
$dbname   = 'cyber_portfolio';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// ===== SYSTÈME DE LANGUE =====
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fr';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['fr', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'];

$langFile = __DIR__ . '/lang/' . $lang . '.php';
if (file_exists($langFile)) {
    $t = require $langFile;
} else {
    die("Fichier de langue introuvable : " . $langFile);
}

// Fonctions d'authentification
function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}
?>