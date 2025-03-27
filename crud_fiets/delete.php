<?php
// auteur: Furkan Kara
// functie: verwijder een brouwer op basis van de brouwcode
include 'functions.php';

// Haal brouwer uit de database
if(isset($_GET['brouwcode'])){

    // test of insert gelukt is
    if(deleteRecord($_GET['brouwcode']) == true){
        echo '<script>alert("Brouwcode: ' . $_GET['brouwcode'] . ' is verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("Brouwer is NIET verwijderd")</script>';
    }
}
?>

