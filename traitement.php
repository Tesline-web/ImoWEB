<?php
// Vérification si le formulaire a bien été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données envoyées par le formulaire
    $name = isset($_POST['nom']) ? $_POST['nom'] : ''; // Correspond à 'name' dans la base
    $mail = isset($_POST['email']) ? $_POST['email'] : ''; // Correspond à 'mail' dans la base
    $number = isset($_POST['telephone']) ? $_POST['telephone'] : ''; // Correspond à 'number' dans la base
    $text = isset($_POST['message']) ? $_POST['message'] : ''; // Correspond à 'text' dans la base

    try {
        // Connexion à la base de données avec un utilisateur ayant les droits nécessaires
        $bdd = new PDO('mysql:host=localhost;dbname=imo', 'root', '');

        // Activation du mode de gestion des erreurs pour PDO
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête SQL pour insérer les données dans la table `message`
        $requete = $bdd->prepare("INSERT INTO message (name, mail, number, text) VALUES (:name, :mail, :number, :text)");

        // Liaison des paramètres avec les données du formulaire
        $requete->bindParam(':name', $name);
        $requete->bindParam(':mail', $mail);
        $requete->bindParam(':number', $number);
        $requete->bindParam(':text', $text);

        // Exécution de la requête
        $requete->execute();

        // Redirection vers une page de confirmation après l'envoi réussi
        header("Location: menu.php");  // Remplacez cette ligne par la page de votre choix.
        exit();

    } catch (PDOException $e) {
        // Gestion des erreurs en cas d'échec de la connexion ou de l'insertion
        echo "Erreur : " . $e->getMessage();
    }
}
?>
