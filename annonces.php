<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['connected'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "annonce";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Handle deletion
    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $sql = "DELETE FROM annonce WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();
        $message = "Annonce supprimée avec succès !";
    }
    
    // Handle insertion
    if (isset($_POST['submit'])) {
        $sql = "INSERT INTO annonce (titre, agence, type_bien, pieces, surface, prix, description, adresse, ville, code_postal)
                VALUES (:titre, :agence, :type_bien, :pieces, :surface, :prix, :description, :adresse, :ville, :code_postal)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titre', $_POST['titre']);
        $stmt->bindParam(':agence', $_POST['agence']);
        $stmt->bindParam(':type_bien', $_POST['type_bien']);
        $stmt->bindParam(':pieces', $_POST['pieces']);
        $stmt->bindParam(':surface', $_POST['surface']);
        $stmt->bindParam(':prix', $_POST['prix']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':adresse', $_POST['adresse']);
        $stmt->bindParam(':ville', $_POST['ville']);
        $stmt->bindParam(':code_postal', $_POST['code_postal']);
        
        $stmt->execute();
        $message = "Annonce ajoutée avec succès !";
    }
    
    // Fetch existing announcements
    $sql = "SELECT * FROM annonce ORDER BY created_at DESC";
    $stmt = $conn->query($sql);
    $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $error = "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des annonces</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
            color: #002155;
            margin-top: 30px;
        }

        .nav-bar {
            background-color: #002155;
            padding: 15px;
            margin-bottom: 30px;
        }

        .nav-bar a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
            width: 100%;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .message {
            text-align: center;
            font-size: 1.2em;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .message-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .property-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .property-card h3 {
            margin-top: 0;
            color: #002155;
        }

        .property-info {
            margin: 10px 0;
        }

        .property-actions {
            margin-top: 15px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="nav-bar">
        <a href="menu.php">Accueil</a>
        <a href="logout.php">Déconnexion</a>
    </div>

    <?php if (isset($message)): ?>
        <div class="message message-success"><?php echo $message; ?></div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <div class="message message-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-container">
        <h1>Ajouter une annonce</h1>
        <form method="POST" action="" class="form-grid">
            <div class="form-full-width">
                <label for="titre">Titre de l'annonce :</label>
                <input type="text" id="titre" name="titre" required>
            </div>

            <div>
                <label for="agence">Agence :</label>
                <select id="agence" name="agence" required>
                    <option value="">Sélectionnez une agence</option>
                    <option value="Rennes">Rennes</option>
                    <option value="Vannes">Vannes</option>
                    <option value="Quimper">Quimper</option>
                </select>
            </div>

            <div>
                <label for="type_bien">Type de bien :</label>
                <select id="type_bien" name="type_bien" required>
                    <option value="">Sélectionnez un type</option>
                    <option value="Maison">Maison</option>
                    <option value="Appartement">Appartement</option>
                    <option value="Studio">Studio</option>
                    <option value="Terrain">Terrain</option>
                </select>
            </div>

            <div>
                <label for="pieces">Nombre de pièces :</label>
                <input type="number" id="pieces" name="pieces" min="1" required>
            </div>

            <div>
                <label for="surface">Surface (m²) :</label>
                <input type="number" id="surface" name="surface" min="1" required>
            </div>

            <div>
                <label for="prix">Prix (€) :</label>
                <input type="number" id="prix" name="prix" min="0" step="1000" required>
            </div>

            <div>
                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" required>
            </div>

            <div>
                <label for="code_postal">Code postal :</label>
                <input type="text" id="code_postal" name="code_postal" pattern="[0-9]{5}" required>
            </div>

            <div class="form-full-width">
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required>
            </div>

            <div class="form-full-width">
                <label for="description">Description :</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-full-width">
                <button type="submit" name="submit" class="btn btn-primary">Ajouter l'annonce</button>
            </div>
        </form>
    </div>

    <h2>Annonces existantes</h2>
    <div class="properties-grid">
        <?php foreach ($annonces as $annonce): ?>
            <div class="property-card">
                <h3><?php echo htmlspecialchars($annonce['titre']); ?></h3>
                <div class="property-info">
                    <p><strong>Agence:</strong> <?php echo htmlspecialchars($annonce['agence']); ?></p>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($annonce['type_bien']); ?></p>
                    <p><strong>Surface:</strong> <?php echo htmlspecialchars($annonce['surface']); ?> m²</p>
                    <p><strong>Pièces:</strong> <?php echo htmlspecialchars($annonce['pieces']); ?></p>
                    <p><strong>Ville:</strong> <?php echo htmlspecialchars($annonce['ville']); ?></p>
                    <p><strong>Prix:</strong> <?php echo number_format($annonce['prix'], 0, ',', ' '); ?> €</p>
                </div>
                <div class="property-actions">
                    <form method="POST" action="" style="display: inline; box-shadow: none; padding: 0;">
                        <input type="hidden" name="id" value="<?php echo $annonce['id']; ?>">
                        <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>