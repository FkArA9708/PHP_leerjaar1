<?php
// auteur: Furkan Kara
// functie: verwijder een bier op basis van de biercode
include 'functions.php';

// Haal bier uit de database


if (!isset($_GET['biercode']) || empty($_GET['biercode'])) {
    echo '<script>alert("Geen biercode opgegeven!"); location.replace("index.php");</script>';
    exit;
}


if(isset($_GET['biercode'])){

    // test of insert gelukt is
    if(deleteRecord($_GET['biercode']) == true){
        echo '<script>alert("Biercode: ' . $_GET['biercode'] . ' is verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("Bier is NIET verwijderd")</script>';
    }
}
?>

