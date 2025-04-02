<?php
// auteur: Furkan Kara
// functie: algemene functies tbv hergebruik

include_once "config.php";

function connectDb(){
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit(); 
    }
}

function crudMain(){
    $txt = "
    <h1>Crud Brouwer</h1>
    <nav>
		<a href='insert.php'>Toevoegen nieuwe brouwer</a>
    </nav><br>";
    echo $txt;

    // Haal alle brouwers record uit de tabel 
    $result = getData(brouwer);

    //print table
    printCrudTabel($result);
}

function getData($table){
    $conn = connectDb();

    $sql = "SELECT * FROM $table";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function getRecord($id){
    $conn = connectDb();

    $sql = "SELECT * FROM " . brouwer . " WHERE brouwcode = :brouwcode";
    $query = $conn->prepare($sql);
    $query->execute([':brouwcode'=>$id]);
    $result = $query->fetch();

    return $result;
}

function printCrudTabel($result){
    $table = "<table border='1'>";

    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</tr>";

    foreach ($result as $row) {
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }
        
        $table .= "<td>
            <form method='post' action='update.php?brouwcode=$row[brouwcode]' >       
                <button>Wzg</button>	 
            </form></td>";

        $table .= "<td>
            <form method='post' action='delete.php?brouwcode=$row[brouwcode]' >       
                <button>Verwijder</button>	 
            </form></td>";

        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}

function updateRecord($row){
    $conn = connectDb();

    $sql = "UPDATE " . brouwer . "
    SET 
        naam = :naam, 
        landcode = :landcode
    WHERE brouwcode = :brouwcode
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':brouwcode'=>$row['brouwcode'],
        ':naam'=>$row['naam'],
        ':landcode'=>$row['landcode'],
    ]);

    return $stmt->rowCount() == 1;
}

function insertRecord($post){
    $conn = connectDb();

    $sql = "
        INSERT INTO " . brouwer . " (brouwcode, naam, landcode)
        VALUES (:brouwcode, :naam, :landcode) 
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':brouwcode'=>$post['brouwcode'],
        ':naam'=>$post['naam'],
        ':landcode'=>$post['landcode']
    ]);

    return $stmt->rowCount() == 1;
}

function deleteRecord($id){
    $conn = connectDb();
    
    $sql = "
    DELETE FROM " . brouwer . 
    " WHERE brouwcode = :brouwcode";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':brouwcode'=>$id
    ]);

    return $stmt->rowCount() == 1;
}
?>