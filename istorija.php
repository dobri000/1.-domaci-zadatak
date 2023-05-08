<?php
session_start();
?>

<html>
    <head>
        <title>Odbojka</title>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body style="background-image: url(./img/background.jpg); background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
    <nav class="navbar navbar-dark bg-dark">
        <ul>
            <li><a href="index.php">Tabela</a></li>
            <li><a href="rezultati.php">Rezutati</a></li>
            <li><a href="unos.php">Unos rezultata</a></li>
            <li><a href="istorija.php">Istorija izmena</a></li>
        </ul>
    </nav>
    <div>
        <h2 class="display-4">Istorija izmena:</h2>
    </div>
    <div id="filter" onchange="filter()">
        <label for="filterIzmena">Odaberite izmene:</label>
        <select id="filterIzmena">
            <option value="sve">Sve</option>
            <option value="unos">Unosi</option>
            <option value="brisanje">Brisanja</option>
        </select>
    </div>
        <div class="izmene">
        <?php
            include "models/Tim.php";
            foreach ($_SESSION['izmene'] as $izmena){
                $imePrvogTima = Tim::returnTeamById($izmena['prviTim'])->getIme();
                $imeDrugogTima = Tim::returnTeamById($izmena['drugiTim'])->getIme();
                if($izmena["izmena"] == "unos"){
                    echo "<div class='unos'>";
                    echo "<h4>Unos</h4>";
                } else {
                    echo "<div class='brisanje'>";
                    echo "<h4>Brisanje</h4>";
                }
                echo "<p>Datum: ".$izmena["datum"]."</p>";
                echo "<p>Prvi tim: ".$imePrvogTima.", setova: ".$izmena["prviTimSetova"]."</p>";
                echo "<p>Drugi tim: ".$imeDrugogTima.", setova: ".$izmena["drugiTimSetova"]."</p>";
                echo "</div>";
            }
        ?>
        </div>
    </body>
</html>
<script>
    function filter(){
        var izbor = $("#filter option:selected").val();
        if(izbor == "sve"){
            $(".unos").css('display', 'block');
            $(".brisanje").css('display', 'block');
        } else if(izbor == "unos"){
            $(".unos").css('display', 'block');
            $(".brisanje").css('display', 'none');
        } else {
            $(".unos").css('display', 'none');
            $(".brisanje").css('display', 'block');
        }
    }
</script>