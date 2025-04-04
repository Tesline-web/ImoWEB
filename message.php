<?php
$name = isset($_GET['name']) ? $_GET['name'] : '';
$mail = isset($_GET['mail']) ? $_GET['mail'] : '';
$number = isset($_GET['number']) ? $_GET['number'] : '';
$text = isset($_GET['message']) ? $_GET['message'] : '';

try {
    $bdd = new PDO('mysql:host=localhost;dbname=imo', 'nom_utilisateur', 'mot_de_passe');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requete = $bdd->prepare("INSERT INTO message (name, mail, number, text) VALUES (:name, :mail, :number, :text)");

    $requete->bindParam(':name', $name);
    $requete->bindParam(':mail', $mail);
    $requete->bindParam(':number', $number);
    $requete->bindParam(':text', $text);

    $requete->execute();

    echo "Données insérées avec succès dans la base de données.";
} catch (PDOException $e) {

    echo "Erreur : " . $e->getMessage();
}
?>
