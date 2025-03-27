<?php
// functie: formulier en database insert brouwer
// auteur: Furkan Kara

echo "<h1>Insert </h1>";

require_once('functions.php');	

// Test of er op de insert-knop is gedrukt
if(isset($_POST) && isset($_POST['btn_ins'])){
    // test of insert gelukt is
    if(insertRecord($_POST) == true){
        echo "<script>alert('Brouwer is toegevoegd')</script>";
    } else {
        echo '<script>alert("Brouwer is NIET toegevoegd")</script>';
    }
}
?>
<html>
<body>
    <form method="post">
        <label for="brouwcode">Brouwcode:</label>
        <input type="text" id="brouwcode" name="brouwcode" required><br>
        
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required><br>
        
        <label for="landcode">Landcode:</label>
        <input type="text" id="landcode" name="landcode" required><br>
        
        <input type="submit" name="btn_ins" value="Insert">
    </form>
    
    <br><br>
    <a href='index.php'>Home</a>
</body>
</html>