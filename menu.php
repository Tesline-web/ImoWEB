<?php
// Initialize $annonces as an empty array
$annonces = [];
$error = null;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "annonce";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch latest announcements
    $sql = "SELECT * FROM annonce ORDER BY created_at DESC LIMIT 6";
    $stmt = $conn->query($sql);
    $annonce = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $error = "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Agence ImoWEB</title>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <style>
    
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
      text-align: center;
      color: #333;
    }

    h1 {
      color: #002155;
      margin-top: 20px;
    }

    h2 {
      font-size: 1.2em;
      color: #444;
      margin-top: 30px;
      font-weight: normal;
      padding: 0 20px;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 40px;
    }

    button {
      width: 320px;
      height: 320px;
      background-color: #ffffff;
      border: 2px solid #ddd;
      border-radius: 10px;
      padding: 10px;
      cursor: pointer;
      transition: transform 0.3s, box-shadow 0.3s;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    button:hover {
      transform: translateY(-10px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    button img {
      max-width: 100%;
      max-height: 120px;
      margin-bottom: 10px;
      border-radius: 5px;
    }

    button p {
      font-size: 1.2em;
      font-weight: bold;
      color: #333;
    }

    .info-section {
      margin-top: 40px;
      padding: 20px;
      background-color: #ffffff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      width: 80%;
      margin-left: auto;
      margin-right: auto;
    }

    .properties-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px;
      padding: 20px;
      margin-top: 20px;
    }

    .property-card {
      background: white;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: left;
      transition: transform 0.3s;
    }

    .property-card:hover {
      transform: translateY(-5px);
    }

    .property-card h3 {
      color: #002155;
      margin: 0 0 10px 0;
      font-size: 1.2em;
    }

    .property-info {
      font-size: 0.9em;
      color: #666;
    }

    .property-info p {
      margin: 5px 0;
    }

    .property-price {
      font-size: 1.2em;
      color: #4CAF50;
      font-weight: bold;
      margin-top: 10px;
    }

    .section-title {
      color: #002155;
      margin-top: 40px;
      font-size: 1.8em;
      text-align: center;
    }
  </style>
</head>

<body>
  <div>
    <h1><img src="https://www.ouestfrance-immo.com/photo-broceliande-immobilier/client/206/broceliande-immobilier-206logo_rect_100-100-ffffff_.gif" alt="Logo"> Quel agence souhaitez-vous consulter ? </h1>
  </div>

  <div class="container">
    <a href="rennes.php">
      <button>
        <img src="https://tse4.mm.bing.net/th?id=OIP.3vxJSt3PntYUGRPd0R_bLQHaE7&pid=Api" alt="Image de Rennes">
        <p>Agence de Rennes</p>
      </button>
    </a>
    <a href="quimper.php">
      <button>
        <img src="https://tse3.mm.bing.net/th?id=OIP.FVrcX7aRVorUSTBY3aDRigHaE9&pid=Api" alt="Image de Quimper">
        <p>Agence de Quimper</p>
      </button>
    </a>
    <a href="vannes.php">
      <button>
        <img src="https://tse2.mm.bing.net/th?id=OIP.6AbFJRgP5COHZYZSFkl-EAHaE8&pid=Api" alt="Image de Vannes">
        <p>Agence de Vannes</p>
      </button>
    </a>
  </div>

  <h2 class="section-title">Nos dernières annonces</h2>
  <?php if ($error): ?>
    <div class="message message-error"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>
  
  <div class="properties-grid">
    <?php if (empty($annonce)): ?>
      <div class="message message-info" style="grid-column: 1/-1; text-align: center; padding: 20px;">
        Aucune annonce disponible pour le moment.
      </div>
    <?php endif; ?>
    
    <?php foreach ($annonce as $annonce): ?>
      <div class="property-card">
        <h3><?php echo htmlspecialchars($annonce['titre']); ?></h3>
        <div class="property-info">
          <p><strong>Agence:</strong> <?php echo htmlspecialchars($annonce['agence']); ?></p>
          <p><strong>Type:</strong> <?php echo htmlspecialchars($annonce['type_bien']); ?></p>
          <p><strong>Surface:</strong> <?php echo htmlspecialchars($annonce['surface']); ?> m²</p>
          <p><strong>Pièces:</strong> <?php echo htmlspecialchars($annonce['pieces']); ?></p>
          <p><strong>Ville:</strong> <?php echo htmlspecialchars($annonce['ville']); ?></p>
          <div class="property-price"><?php echo number_format($annonce['prix'], 0, ',', ' '); ?> €</div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="info-section">
    <h2>Brocéliande Immo est une agence immobilière avec des agences à Rennes, Quimper, et Vannes, fondée il y a 40 ans par Arthur et sa demi-sœur Anna.</h2>
  </div>
</body>
</html>