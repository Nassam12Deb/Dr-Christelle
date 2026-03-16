<?php
require_once __DIR__ . '/../config.php';

$error = '';
$success = '';

$token = $_GET['token'] ?? '';

if (!$token) {
    header('Location: login.php');
    exit;
}

// Vérifier si le token est valide et non expiré
$stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()");
$stmt->execute([$token]);
$reset = $stmt->fetch();

if (!$reset) {
    $error = "Lien de réinitialisation invalide ou expiré.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $reset) {
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // Mettre à jour le mot de passe de l'utilisateur correspondant à l'email
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $update->execute([$hash, $reset['email']]);

        // Supprimer le token utilisé
        $delete = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
        $delete->execute([$token]);

        $success = "Mot de passe modifié avec succès. <a href='login.php'>Connectez-vous</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: var(--bg-dark);
            font-family: 'Inter', sans-serif;
        }
        .reset-container {
            background: var(--surface-dark);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 30px -10px rgba(0,0,0,0.5);
        }
        .reset-container h1 {
            color: var(--accent-primary);
            margin-bottom: 30px;
            text-align: center;
            font-size: 1.8rem;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: var(--bg-dark);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-primary);
            font-size: 1rem;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(0,255,195,0.1);
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: var(--accent-primary);
            color: #0a0c0f;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #00e6b0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,255,195,0.3);
        }
        .error {
            color: #ff4444;
            text-align: center;
            margin-bottom: 20px;
        }
        .success {
            color: var(--accent-primary);
            text-align: center;
            margin-bottom: 20px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--text-secondary);
            text-decoration: none;
        }
        .back-link:hover {
            color: var(--accent-primary);
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h1>Réinitialisation du mot de passe</h1>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if ($reset && !$success): ?>
        <form method="POST">
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Nouveau mot de passe" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirmer le mot de passe" required>
            </div>
            <button type="submit" class="btn">Réinitialiser</button>
        </form>
        <?php endif; ?>
        <a href="login.php" class="back-link">Retour à la connexion</a>
    </div>
</body>
</html>