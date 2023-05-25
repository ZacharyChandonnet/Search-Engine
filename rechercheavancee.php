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
        <select name="category" id="category" onchange="updateDisplayOptions()">
            <option value="entreprises">Entreprises</option>
            <option value="activites">Activités</option>
            <option value="evenements">Événements</option>
            <option value="forfaits">Forfaits</option>
        </select>
        <select name="display" id="display">
            <option value="nom">Noms</option>
            <option value="description">Descriptions</option>
        </select>
        <input type="text" name="search" id="search" placeholder="Recherche">
        <button type="submit">Rechercher</button>
        <?php
        $pdo = new PDO("sqlite:database.sqlite");

        if (isset($_GET['search'])) {
            $category = $_GET['category'];
            $display = $_GET['display'];
            $search = $_GET['search'];

            if (empty($search)) {
                echo "<p>Veuillez entrer une recherche valide</p>";
            } else {
                $stmt = $pdo->prepare("SELECT * FROM $category WHERE nom LIKE '%$search%' ORDER BY nom");
                $stmt->execute();
                $results = $stmt->fetchAll();

                if (count($results) > 0) {
                    echo "<h2>Résultats de la recherche pour \"" . $search . "\"</h2>";
                    // Afficher le sous-titre correspondant à la catégorie sélectionnée
                    echo "<h3>Résultats de recherche des " . ucfirst($display) . " des " . ucfirst($category) . " :</h3><ul>";
                    foreach ($results as $result) {
                        $url = $category . ".php?id=" . $result['id'];
                        echo "<li><a href=\"$url\">" . $result[$display] . "</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Aucun résultat trouvé pour \"" . $search . "\"</p>";
                }
            }
        }
        ?>
    </form>
    
    <script>
        function updateDisplayOptions() {
            var category = document.getElementById("category");
            var display = document.getElementById("display");

            if (category.value === "evenements") {
                var option = document.createElement("option");
                option.value = "emplacement";
                option.text = "Emplacement";
                display.add(option);
            } else {
                for (var i = 0; i < display.options.length; i++) {
                    if (display.options[i].value === "emplacement") {
                        display.remove(i);

                    }
                }
            }
            
            if (category.value === "entreprises" || category.value === "forfaits") {
                var option = document.createElement("option");
                option.value = "type";
                option.text = "Ville";
                display.add(option);
            } else {
                for (var i = 0; i < display.options.length; i++) {
                    if (display.options[i].value === "type") {
                        display.remove(i);

                    }
                }
            }

            if (category.value === "activites") {
                var option = document.createElement("option");
                option.value = "type";
                option.text = "Type";
                display.add(option);
            } else {
                for (var i = 0; i < display.options.length; i++) {
                    if (display.options[i].value === "type") {
                        display.remove(i);

                    }
                }
            }

        }
    </script>
</body>

</html>