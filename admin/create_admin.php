<?php
require_once __DIR__ . '/../config.php';

// Modifiez ces valeurs selon vos besoins
$username = 'admin';
$password = 'admin123'; // Changez ce mot de passe après la première connexion
$email = 'admin@example.com';

$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->execute([$username, $hash, $email]);
    echo "Utilisateur '$username' créé avec succès. Mot de passe : $password<br>";
    echo "Vous pouvez maintenant vous connecter à <a href='login.php'>l'interface d'administration</a>.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>