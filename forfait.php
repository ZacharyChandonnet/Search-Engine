<?php

$id = "";
$nom = "";
$description = "";
$type = "";
$date_debut = "";
$date_fin = "";
$prix = "";
$dispo = "";

$pdo = new PDO("sqlite:database.sqlite");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (!isset($_GET['id'])) {
    header('location:index.php');
    die;
}

$id = $_GET['id'];
$sql = "SELECT nom, description FROM forfaits ";
$sql = "SELECT * FROM forfaits WHERE id=:id ";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);

$stmt->execute();

$forfait = $stmt->fetch();
$id = $forfait['id'];
$nom = $forfait['nom'];
$type = $forfait['type'];
$description = $forfait['description'];
$date_debut = $forfait['date_debut'];
$date_fin = $forfait['date_fin'];
$prix = $forfait['prix'];
$dispo = $forfait['dispo'];



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Résultats de recherche</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/recherche.css" />
  </head>
  <body>
    <header class="header">
      <h1 class="header__title"><?php echo $nom; ?></h1>
      <p class="header__type"><?php echo $type; ?></p>
    </header>
    <main class="main">
      <div class="container">
        <div class="description">
          <h2 class="description__title">Description</h2>
          <p class="description__text"><?php echo $description; ?></p>
        </div>
        <div class="details">
          <ul class="details__list">
            <li class="details__item">
              <span class="details__label">Date Début:</span>
              <span class="details__value"><?php echo $date_debut; ?></span>
            </li>
            <li class="details__item">
              <span class="details__label">Date Fin:</span>
              <span class="details__value"><?php echo $date_fin; ?></span>
            </li>
            <li class="details__item">
              <span class="details__label">Prix:</span>
              <span class="details__value"><?php echo $prix; ?>$</span>
            </li>
            <li class="details__item">
              <span class="details__label">Disponibilité:</span>
              <span class="details__value"><?php echo $dispo; ?></span>
            </li>
          </ul>
        </div>
      </div>
    </main>
    <script type="module" src="js/App.js"></script>
  </body>
</html>