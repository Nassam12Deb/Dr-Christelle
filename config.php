<?php
session_start();

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
// Priorité : 1) paramètre GET  2) session  3) défaut FR
if (isset($_GET['lang']) && in_array($_GET['lang'], ['fr', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
    session_write_close();
    session_start();
}

$lang = $_SESSION['lang'] ?? 'fr';

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