<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "annonce";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['login'])) {
        // Récupérer l'email et le mot de passe du formulaire
        $mail = $_POST['mail'];
        $password = $_POST['password'];

        // Vérifier si l'utilisateur existe
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si l'utilisateur existe
        if ($user) {
            // Vérifier si le mot de passe correspond
            if ($password === $user['password']) {
                // Authentification réussie, démarrer la session
                $_SESSION['connected'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_mail'] = $user['mail'];
                $_SESSION['user_role'] = $user['role'];

                // Redirection vers annonces.php pour la gestion des annonces
                header("Location: annonces.php");
                exit();
            } else {
                $_SESSION['error'] = "Mot de passe incorrect.";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Aucun utilisateur trouvé avec cet email.";
            header("Location: login.php");
            exit();
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>
