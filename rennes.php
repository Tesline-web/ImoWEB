<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agence ImoWEB - Rennes</title>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <style>
    
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
      color: #333;
    }

    h1 {
      color: #002155;
      margin-top: 30px;
    }

    h2 {
      font-size: 1.5em;
      color: #333;
    }

    .nav {
      display: flex;
      justify-content: center;
      list-style-type: none;
      padding: 0;
      margin: 20px 0;
    }

    .nav-item {
      margin-right: 20px;
    }

    .nav-link {
      text-decoration: none;
      color: #002155;
      font-weight: bold;
      font-size: 1.1em;
    }

    .nav-link:hover {
      color: #4CAF50;
    }

    .image-container {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }

    .image-container img {
      width: 30%;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .info-section {
      text-align: center;
      margin-top: 40px;
      padding: 20px;
      background-color: #ffffff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .info-section h1 {
      color: #002155;
    }

    form {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 30px auto;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      color: #333;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1.1em;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>

  <ul class="nav">
    <?php if (!isset($_SESSION['connected'])): ?>
    <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
    <?php endif; ?>
    <?php if (isset($_SESSION['connected'])): ?>
    <li class="nav-item"><a class="nav-link" href="location.php">Location</a></li>
    <li class="nav-item"><a class="nav-link" href="vente.php">Vente</a></li>
    <?php endif; ?>
    <?php if (!isset($_SESSION['connected'])): ?>
    <li class="nav-item"><a class="nav-link" href="login.php">Connexion</a></li>
    <?php endif; ?>
  </ul>

  <div style="text-align:center">
    <h1>Bienvenue sur l'agence de Rennes !</h1>
    <h2>Offre du jour !</h2>
  </div>

  <div class="image-container">
    <img src="https://tse4.mm.bing.net/th?id=OIP.XFjNXzI1iGlWpjT_HB0sUgHaGL&pid=Api" alt="Image de l'offre 1">
    <img src="https://tse3.mm.bing.net/th?id=OIP.Uhyh0fOQJ2O0-APOgszFeAHaKd&pid=Api" alt="Image de l'offre 2">
    <img src="https://tse4.mm.bing.net/th?id=OIP.nG15rNOUaVZIrB17XK0PeAHaJ4&pid=Api" alt="Image de l'offre 3">
  </div>

  <div class="info-section">
    <h1>Nous vous proposons l'achat d'un appartement de 50m² situé au centre de Rennes, à 5 minutes des boutiques !</h1>
    <p>Un appartement 1 pièce avec 1 cuisine fermée et une salle de bain.</p>
    <p>Le tout rénové récemment et prêt à être habité, alors qu'attendez-vous !</p>
  </div>

  <div class="info-section">
    <h1>Vous voulez directement envoyer votre dossier ?</h1>
    <p>Remplissez le formulaire et on vous répondra au plus vite !</p>
  </div>

  <form action="traitement.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" required>
    </div>

    <div class="form-group">
      <label for="email">Adresse e-mail :</label>
      <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
      <label for="telephone">Numéro de téléphone :</label>
      <input type="tel" id="telephone" name="telephone" required>
    </div>

    <div class="form-group">
      <label for="message">Message :</label>
      <textarea id="message" name="message" rows="5" required></textarea>
    </div>

    <button type="submit">Envoyer</button>
  </form>

</body>
</html>