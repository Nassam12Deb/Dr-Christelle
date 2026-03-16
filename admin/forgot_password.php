<?php
require_once __DIR__ . '/../config.php';

// Si déjà connecté, rediriger vers dashboard
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (empty($email)) {
        $error = "Veuillez saisir votre adresse email.";
    } else {
        // Vérifier si l'email existe dans la table users
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Générer un token unique
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Insérer le token dans la table password_resets
            $insert = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
            $insert->execute([$email, $token, $expires]);

            // Envoyer l'email
            $resetLink = BASE_URL . "admin/reset_password.php?token=" . urlencode($token);
            $subject = "Réinitialisation de votre mot de passe";
            $messageBody = "Bonjour,\n\nPour réinitialiser votre mot de passe, cliquez sur le lien suivant :\n$resetLink\n\nCe lien est valable pendant 1 heure.\n\nSi vous n'avez pas demandé cette réinitialisation, ignorez cet email.";

            // Pour les tests, on peut afficher le lien si mail() ne fonctionne pas
            // En production, utilisez un vrai serveur SMTP
            if (mail($email, $subject, $messageBody)) {
                $message = "Un email de réinitialisation a été envoyé à votre adresse.";
            } else {
                // En local, on peut afficher le lien pour tester
                $message = "Mode test : lien de réinitialisation : <a href='$resetLink'>$resetLink</a>";
            }
        } else {
            // Ne pas révéler si l'email existe ou non
            $message = "Si cette adresse email est associée à un compte, vous recevrez un email de réinitialisation.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
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
        .forgot-container {
            background: var(--surface-dark);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 30px -10px rgba(0,0,0,0.5);
        }
        .forgot-container h1 {
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
        .message {
            color: var(--accent-primary);
            text-align: center;
            margin-bottom: 20px;
        }
        .error {
            color: #ff4444;
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
    <div class="forgot-container">
        <h1>Mot de passe oublié</h1>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Votre adresse email" required>
            </div>
            <button type="submit" class="btn">Envoyer le lien de réinitialisation</button>
        </form>
        <a href="login.php" class="back-link">Retour à la connexion</a>
    </div>
</body>
</html>