<?php
require_once __DIR__ . '/../config.php';

// Si déjà connecté, rediriger vers dashboard
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
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

        .login-container {
            background: var(--surface-dark);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.5);
        }

        .login-container h1 {
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
            box-shadow: 0 0 0 3px rgba(0, 255, 195, 0.1);
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
            box-shadow: 0 5px 15px rgba(0, 255, 195, 0.3);
        }

        .error {
            color: #ff4444;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Espace Administrateur</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" autocomplete="off" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" autocomplete="off" required>
            </div>
            <button type="submit" class="btn">Se connecter</button>
        </form>
        <div style="text-align: center; margin-top: 15px;">
            <a href="forgot_password.php" style="color: var(--accent-primary); text-decoration: none;">Mot de passe
                oublié ?</a>
        </div>
    </div>
</body>

</html>