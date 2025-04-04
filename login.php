<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
        crossorigin="anonymous">
    <style>
        /* Style pour le menu de navigation */
        .nav {
            display: flex;
            justify-content: center;
            list-style-type: none;
            padding: 0;
            background-color: #002155;
            margin: 0;
        }

        .nav-item {
            margin-right: 20px;
        }

        .nav-link {
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: 1.1em;
        }

        .nav-link:hover {
            color: #4CAF50;
        }

        /* Style pour le formulaire de connexion */
        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 1em;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        /* Centrer le formulaire dans la page */
        .container-fluid {
            padding-top: 50px;
        }

        .row {
            margin-top: 20px;
        }

        /* Style pour la page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            color: #002155;
        }

        /* Style pour la colonne du formulaire de connexion */
        .offset-4 {
            margin-top: 50px;
        }

        .col-4 {
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Quelques autres améliorations pour la navigation */
        .nav-item:last-child {
            margin-right: 0;
        }

    </style>
</head>

<body>
    <ul class="nav">
        <?php if (!isset($_SESSION['connected'])): ?>
        <li class="nav-item">
            <a class="nav-link" href="menu.php">Menu</a>
        </li>
        <?php endif; ?>
        <?php if (!isset($_SESSION['connected'])): ?>
        <li class="nav-item">
            <a class="nav-link" href="login.php">Connexion</a>
        </li>
        <?php endif; ?>
    </ul>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php include_once('functions.php'); ?>
            </div>
        </div>
        <div class="row">
            <div class="offset-4 col-4">
                <form method="POST" action="treatment_login.php">
                    <div class="form-group">
                        <label for="mail">Adresse e-mail</label>
                        <input name="mail" type="email" class="form-control" id="mail" aria-describedby="emailHelp" placeholder="Entrez l'email">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe">
                    </div>
                    <button name="login" type="submit" class="btn btn-primary">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>