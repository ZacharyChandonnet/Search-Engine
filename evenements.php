<?php

$id = "";
$date_debut = "";
$description = "";
$date_fin = "";
$ville = "";
$nom = "";
$emplacement = "";
$prix = "";

$pdo = new PDO("sqlite:database.sqlite");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (!isset($_GET['id'])) {
    header('location:index.php');
    die;
}

$id = $_GET['id'];
$sql = "SELECT nom, description FROM evenements ";
$sql = "SELECT * FROM evenements WHERE id=:id ";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);

$stmt->execute();

$evenement = $stmt->fetch();
$id = $evenement['id'];
$nom = $evenement['nom'];
$description = $evenement['description'];
$date_debut = $evenement['date_debut'];
$date_fin = $evenement['date_fin'];
$ville = $evenement['ville'];
$emplacement = $evenement['emplacement'];
$prix = $evenement['prix'];

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
              <span class="details__label">Ville:</span>
              <span class="details__value"><?php echo $ville; ?></span>
            </li>
            <li class="details__item">
              <span class="details__label">Emplacement:</span>
              <span class="details__value"><?php echo $emplacement; ?></span>
            </li>
          </ul>
        </div>
      </div>
    </main>
    <script type="module" src="js/App.js"></script>
  </body>
</html>