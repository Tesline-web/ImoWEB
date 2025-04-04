<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>administration des articles </title>
    <link rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
</head>
<body>
    <?php 
    include_once('functions.php');
    if(isset($_SESSION['connected']) && $_SESSION['connected'] == true){

    } else{
        return header("Location: login.php");
      }
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php include_once('location.php'); 
                include_once('vente.php'); ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <h1> Toutes les annonces ! </h1>
                </div>
            </div>
            <?php   $articles = get_all_articles_admin(); ?>
            <div class="row">
               <div class="col-12">
                 <table>
                    <tr>
                        <th>id :</th>
                        <th>Titre :</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                        
                    </tr>
                    <?php foreach($articles as $article): ?>
                    <tr>
                        <td><?= $article['id'] ?></td>
                        <td><?= $article['title'] ?></td>
                        <td> <a class="btn btn-warning" href="updatepost.php?id=<?= $article['id'] ?>">Modifier</a> </td>
                        <td><?php include("functions.php")  ?></td>
                    </tr>
                    <?php endforeach; ?>
                 </table>
               </div> 
            </div>     
        </div>
    </div>

   
</body>
</html>