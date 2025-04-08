<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "nexus";
//Database connectie

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error); //Als het connectie niet werkt, gaat het een foutmelding weergeven
}


?>







<html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:;">
    <title>Netux Herenpagina HustleFit</title>
    <link rel="stylesheet" href="netux_herenpagina.css"> <!--Hier wordt het CSS gekoppeld aan de HTML bestand-->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div id="logo">
            <img src="Hustlefit logo(1).jpg" alt="Logo"> <!--Logo in het navbar-->
        </div>
        <ul class="navbar-menu">
            <li><a href="#">Sales</a></li> <!--Navbar menu-->
            <li><a href="#">Sportkleding</a></li>
            <li><a href="#">Accessoires</a></li>
            <li><a href="#">Nieuw</a></li>
            <li><a href="crud_categorie_nexus.php">Categorieën</a></li>

        </ul>
        <div class="logos">
           
            <img src="heart-removebg-preview.png" alt="favorieten" id="favorite_homepage" width="50px" height="50px"> <!--Meer navbar opties  om erop te klikken-->
            <img src="user_1077114__1_-removebg-preview.png" alt="gebruiker" id="user_homepage" width="50px" height="50px">
            <img src="bag_3502696-removebg-preview.png" alt="shoppingcart" id="shoppingcart_homepage" width="50px" height="50px">
            
        </div>
    </nav>

    <!--header homepage-->
    <section class="header-hustlefit-heren">
        <div class="heerkleding-box">
        <img src="bandan-mohammed-JqCMxXa3z9Q-unsplash.jpg" alt="heerkleding" id="heerkledingheader">
        <p id="herenkleding">Herenkleding</p>
         </div>
    </section>








<div class="producten-container">
    </html>

    <?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "nexus";

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepared statement for SQL query to prevent SQL injection
$stmt = $conn->prepare("SELECT p.* FROM product p
                        JOIN categorie c ON p.ID_categorie = c.ID_categorie 
                        WHERE c.categorie_naam = ?");
$categorie_naam = 'mannen';
$stmt->bind_param("s", $categorie_naam); // 's' indicates the parameter type (string)

// Execute query
$stmt->execute();
$result = $stmt->get_result();

// Display products
if ($result->num_rows > 0) {
    echo "<div class='producten-lijst'>";
    while ($row = $result->fetch_assoc()) {
        $productNaam = htmlspecialchars($row["naam_product"]);
        $productPrijs = htmlspecialchars($row["prijs_product"]);
        $productAfbeelding = htmlspecialchars($row["afbeelding_product"]);

        if (!empty($productAfbeelding)) {
            $isExternal = (strpos($productAfbeelding, 'http') === 0);
            $imgSrc = $isExternal ? $productAfbeelding : "images/" . $productAfbeelding;
        } else {
            $imgSrc = "images/placeholder.jpg";
        }

        echo "<div class='product'>";
        echo "<h3>{$productNaam}</h3>";
        echo "<p>Prijs: €{$productPrijs}</p>";
        echo "<img src='{$imgSrc}' alt='Product afbeelding' style='width: 150px; height: auto; border: 1px solid #ccc;'>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "Geen producten gevonden.";
}

$stmt->close();
$conn->close();
?>

<html>
        <!--footer homepage-->
        <section class="footer-hustlefit-homepage">
        <img src="Hustlefit logo(1).jpg" alt="Hustlefit" id="hustlefitlogo"> <!--Logo in de footer-->
        <div class="footeritems-hustlefit">
            <ul>
        <li>Over ons</li>
        <li>Contact</li> <!--Meer links in de footer-->
        <li>FAQ</li>
        </ul>
        </div>
        <div class="sociaalmedia-footer">
        <ul>
        <li><img src="x.png" alt="X" width="50px" height="50px"></li>
        <li><img src="instagramlogohustlefit.png" alt="Instagram" width="50px" height="50px"></li> <!--Sociaal media links in de footer-->
        <li><img src="youtubelogohustlefit.png" alt="YouTube" width="50px" height="50px"></li>
        </ul>
        </div>
    </section>
    <script src="Netux.js"></script> <!--Javascript bestand wordt gekoppeld aan de HTML bestand-->
</body>
</html>
</div>

        
    </section>
</body>
</html>






