<?php
session_start();
?>

<html>
    <head>
        <title>Odbojka</title>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    </head>
    <body>
    <nav>
        <ul>
            <li><a href="index.php">Tabela</a></li>
            <li><a href="rezultati.php">Rezutati</a></li>
            <li><a href="unos.php">Unos rezultata</a></li>
            <li><a href="istorija.php">Istorija izmena</a></li>
        </ul>
    </nav>

    <div class="filter" onchange="filter()">
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
                if($izmena["izmena"] == "unos"){
                    echo "<div class='unos'>";
                    echo "<h4>Unos</h4>";
                } else {
                    echo "<div class='brisanje'>";
                    echo "<h4>Brisanje</h4>";
                }
                echo "<p>datum:".$izmena["datum"]."</p>";
                echo "<p>prviTimId:".$izmena["prviTim"].", prviTimSetova:".$izmena["prviTimSetova"]."</p>";
                echo "<p>drugiTimId:".$izmena["drugiTim"].", drugiTimSetova:".$izmena["drugiTimSetova"]."</p>";
                echo "</div>";
            }
        ?>
        </div>
    </body>
</html>
<script>
    function filter(){
        var izbor = $(".filter option:selected").val();
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