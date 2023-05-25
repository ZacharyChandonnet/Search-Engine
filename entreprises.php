<?php

$id = "";
$nom = "";
$description = "";
$type = "";
$specialite = "";
$adresse = "";
$email = "";
$phone = "";
$postal = "";
$ressource = "";

$pdo = new PDO("sqlite:database.sqlite");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (!isset($_GET['id'])) {
    header('location:index.php');
    die;
}

$id = $_GET['id'];
$sql = "SELECT nom, description FROM entreprises ";
$sql = "SELECT * FROM entreprises WHERE id=:id ";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);

$stmt->execute();

$entreprise = $stmt->fetch();
$id = $entreprise['id'];
$nom = $entreprise['nom'];
$type = $entreprise['type'];
$description = $entreprise['description'];
$specialite = $entreprise['specialite'];
$adresse = $entreprise['adresse'];
$email = $entreprise['email'];
$phone = $entreprise['phone'];
$postal = $entreprise['code_postal'];
$ressource = $entreprise['personne_ressource'];

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
              <span class="details__label">Spécialité:</span>
              <span class="details__value"><?php echo $specialite; ?></span>
            </li>
            <li class="details__item">
              <span class="details__label">adresse:</span>
              <span class="details__value"><?php echo $adresse; ?></span>
            </li>
            <li class="details__item">
              <span class="details__label">Email:</span>
              <span class="details__value"><?php echo $email; ?></span>
            </li>
            <li class="details__item">
              <span class="details__label">Téléphone:</span>
              <span class="details__value"><?php echo $phone; ?></span>
            </li>
            <li class="details__item">
              <span class="details__label">Code Postal:</span>
              <span class="details__value"><?php echo $postal; ?></span>
            </li>
            <li class="details__item">
              <span class="details__label">Ressource:</span>
              <span class="details__value"><?php echo $ressource; ?></span>
            </li>
          </ul>
        </div>
      </div>
    </main>
    <script type="module" src="js/App.js"></script>
  </body>
</html>