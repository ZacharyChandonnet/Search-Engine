<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  <title>Recherche</title>
</head>

<body>
  <h1>Agrotourisme Laurentides</h1>
  <div id="search-results"></div>
  <form method="GET">
    <input type="text" name="search" id="search" placeholder="Recherche">
    <button type="submit">Rechercher</button>
    <?php

    $pdo = new PDO("sqlite:database.sqlite");
    if (isset($_GET['search'])) {
      $search = $_GET['search'];
      if (empty($search)) {
        echo "<p>Veuillez entrer une recherche valide</p>";
      } else {
        $stmt = $pdo->prepare("SELECT * FROM activites  WHERE nom LIKE '%" . $search . "%' ORDER BY nom");
        $stmt->execute();
        $results = $stmt->fetchAll();

        $stmt1 = $pdo->prepare("SELECT * FROM entreprises  WHERE nom LIKE '%" . $search . "%' ORDER BY nom");
        $stmt1->execute();
        $results1 = $stmt1->fetchAll();

        $stmt1 = $pdo->prepare("SELECT * FROM evenements  WHERE nom LIKE '%" . $search . "%' ORDER BY nom");
        $stmt1->execute();
        $results2 = $stmt1->fetchAll();

        $stmt3 = $pdo->prepare("SELECT * FROM forfaits  WHERE nom LIKE '%" . $search . "%' ORDER BY nom");
        $stmt3->execute();
        $results3 = $stmt3->fetchAll();

        if (count($results) > 0 || count($results1) > 0 || count($results2) > 0 || count($results3) > 0) {
          echo "<h2>Résultats de la recherche pour \"" . $search . "\"</h2><ul>";
          echo "<h3> Résultat pour les Activités : </h3>";
          foreach ($results as $result) {
            echo "<li><a href=\"activite.php?id=" . $result['id'] . "\">" . $result['nom'] . "</a></li>";
          }
          echo "<h3> Résultat pour les Entreprises : </h3>";
          foreach ($results1 as $result) {
            echo "<li><a href=\"entreprise.php?id=" . $result['id'] . "\">" . $result['nom'] . "</a></li>";
          }
          echo "<h3> Résultat pour les Événements : </h3>";
          foreach ($results2 as $result) {
            echo "<li><a href=\"evenement.php?id=" . $result['id'] . "\">" . $result['nom'] . "</a></li>";
          }
          echo "<h3> Résultat pour les Forfaits : </h3>";
          foreach ($results3 as $result) {
            echo "<li><a href=\"forfait.php?id=" . $result['id'] . "\">" . $result['nom'] . "</a></li>";
          }
          echo "</ul>";
        } else {
          echo "<p>Aucun résultat trouvé pour \"" . $search . "\"</p>";
        }
      }
    }
    ?>
  </form>
</body>

</html>