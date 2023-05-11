<?php

$id = "";
$nom = "";
$description = "";
$type = "";
$duree = "";
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
$sql = "SELECT nom, description FROM activites ";
$sql = "SELECT * FROM activites WHERE id=:id ";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);

$stmt->execute();

$activite = $stmt->fetch();
$id = $activite['id'];
$nom = $activite['nom'];
$type = $activite['type'];
$description = $activite['description'];
$duree = $activite['duree'];
$prix = $activite['prix'];
$dispo = $activite['nb_dispo'];
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
              <span class="details__label">Durée:</span>
              <span class="details__value"><?php echo $duree; ?></span>
            </li>
            <li class="details__item">
              <span class="details__label">Prix:</span>
              <span class="details__value"><?php echo $prix; ?></span>
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