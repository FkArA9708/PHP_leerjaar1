<?php

function CrudCategorie() {
    $txt = "
    <h1>Crud Categorie</h1>
    <nav>
        <a href='insert_categorie_nexus.php'>Toevoegen nieuwe categorie</a>
    </nav>";

    echo $txt;

    $result = GetData("categorie");
    
    if ($result) {
        PrintCrudCategorie($result);
    } else {
        echo "<p>Geen gegevens gevonden.</p>";
    }
}

function PrintCrudCategorie($result) {
    
    $table = "<table border='1'>";

    
    if (!empty($result)) {
        $headers = array_keys($result[0]);
        $table .= "<tr>";
        foreach ($headers as $header) {
            $table .= "<th bgcolor='gray'>" . htmlspecialchars($header) . "</th>";
        }
        $table .= "<th bgcolor='gray'>Wijzigen</th>";
        $table .= "<th bgcolor='gray'>Verwijderen</th>";
        $table .= "</tr>";

        // Print elke rij
        foreach ($result as $row) {
            $table .= "<tr>";

            // Print elke kolom
            foreach ($row as $cell) {
                $table .= "<td>" . htmlspecialchars($cell) . "</td>";
            }

            // Twee extra kolommen
            $table .= "<td>
             <form method='post' action='update_categorie_nexus.php?id=" . $row['ID-categorie'] . "' >      
                    <button name='wzg'>Wijzigen</button>    
            </form>
            </td>";

            $table .= "<td>
                <a href='delete_categorie_nexus.php?id=" . $row['ID-categorie'] . "'>Delete</a>
            </td>";

            $table .= "</tr>";
        }
    } else {
        $table .= "<tr><td colspan='100%'>Geen gegevens beschikbaar.</td></tr>";
    }

    $table .= "</table>";

    echo $table;
}

function UpdateCategorie($row) {
    try {
        $conn = ConnectDb();
        $query = $conn->prepare("UPDATE categorie SET categorie_naam = :categorie_naam WHERE `ID-categorie` = :id_categorie");

        $query->execute([
            ':id_categorie' => $row['ID-categorie'],
            ':categorie_naam' => $row['categorie_naam']
        ]);

        echo "Categorie bijgewerkt!";
    } catch (Exception $e) {
        echo "Fout bij bijwerken: " . $e->getMessage();
    }
}

function GetData($table) {
    $allowedTables = ['categorie', 'product', 'klanten', 'leverancier', 'bestelling']; // Whitelist om SQL injectie te voorkomen

    if (!in_array($table, $allowedTables)) {
        die("Ongeldige tabelnaam.");
    }

    $conn = ConnectDb();
    $query = $conn->prepare("SELECT * FROM $table");
    $query->execute();
    return $query->fetchAll();
}

function ConnectDb() {
    require_once 'confignexus.php';
    
    try {
        $conn = new PDO($dsn, $user, $pass, $options);
        return $conn;
    } catch (PDOException $e) {
        die("Verbinding mislukt: " . $e->getMessage());
    }
}

function InsertCategorie($post) {
    try {
        $conn = ConnectDb();
    
       $query = $conn->prepare("
            INSERT INTO categorie (`categorie_naam`)
            VALUES (:categorie_naam)
        ");

        $query->execute([
            ':categorie_naam' => $post['categorie_naam']
        ]);

        return true;
    
    } catch (PDOException $e) {
        echo "Insert failed: " . $e->getMessage();
        return false;
    }
}

function DeleteCategorie($id) {
    echo "Delete categorie<br>";

    try {
        $conn = ConnectDb();
    
        $query = $conn->prepare("
            DELETE FROM categorie 
            WHERE `ID-categorie` = :id");

        return $query->execute([':id' => $id]);
    
    } catch (PDOException $e) {
        echo "Delete failed: " . $e->getMessage();
        return false;
    }
}
    

function GetCategorie($id) {
    // Connect database
    $conn = ConnectDb();

  
    $query = $conn->prepare("SELECT * FROM categorie WHERE `ID-categorie` = :id");
    $query->execute([':id' => $id]);
    $result = $query->fetch();

    return $result;
}



function GetProduct($id) {
    $conn = ConnectDb();
    $query = $conn->prepare("SELECT * FROM product WHERE `ID-product` = :id");
    $query->execute([':id' => $id]);
    return $query->fetch();
}

function GetKlant($id) {
    $conn = ConnectDb();
    $query = $conn->prepare("SELECT * FROM klanten WHERE `ID-klant` = :id");
    $query->execute([':id' => $id]);
    return $query->fetch();
}

function GetLeverancier($id) {
    $conn = ConnectDb();
    $query = $conn->prepare("SELECT * FROM leverancier WHERE `ID` = :id");
    $query->execute([':id' => $id]);
    return $query->fetch();
}

function GetBestelling($id) {
    $conn = ConnectDb();
    $query = $conn->prepare("SELECT * FROM bestelling WHERE `ID-bestelling` = :id");
    $query->execute([':id' => $id]);
    return $query->fetch();
}
?>