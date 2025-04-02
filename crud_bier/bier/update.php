<?php
    // functie: update bier
    // auteur: Furkan Kara

    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(updateRecord($_POST) == true){
            echo "<script>alert('Bier is gewijzigd')</script>";
        } else {
            echo '<script>alert("Bier is NIET gewijzigd")</script>';
        }
    }

    // Test of biercode is meegegeven in de URL
    if(isset($_GET['biercode'])){  
        // Haal alle info van de betreffende biercode $_GET['biercode']
        $biercode = $_GET['biercode'];
        $row = getRecord($biercode);
    




        

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Bier</title>
</head>
<body>
  <h2>Wijzig Bier</h2>
  <form method="post">
    
    <input type="hidden" id="merk" name="biercode" required value="<?php echo $row['biercode']; ?>"><br>
    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required value="<?php echo $row['naam']; ?>"><br>

    <label for="soort">Soort:</label>
    <input type="text" id="soort" name="soort" required value="<?php echo $row['soort']; ?>"><br>

    <label for="stijl">Stijl:</label>
    <input type="text" id="stijl" name="stijl" required value="<?php echo $row['stijl']; ?>"><br>

    <label for="alcohol">Alcohol:</label>
    <input type="number" id="alcohol" name="alcohol" required value="<?php echo $row['alcohol']; ?>"><br>

    <label for="brouwcode">Brouwcode:</label>
    <input type="number" id="brouwcode" name="brouwcode" required value="<?php echo $row['brouwcode']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='index.php'>Home</a>
</body>
</html>

<?php
    } else {
        echo "Geen biercode opgegeven<br>";
    }
?>