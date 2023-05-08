<?php
session_start();
?>

<html>

<head>
    <title>Odbojka</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <script>
        function predloziTim(str){
            if(str.length == 0){
                document.getElementById("timHint").innerHTML = "Predlozi:";
                return;
            }
            $.ajax({
                url:"suggest.php",
                method:"POST",
                data:{name:str},
                success:function(data){
                    document.getElementById("timHint").innerHTML = data;
                }
            })
        }

        function prikaziUtakmiceTima(){
            var name = document.getElementById("tim").value.toLowerCase();
            $.ajax({
                url:"filter.php",
                method:"POST",
                data:{name:name},
                success:function(data){
                    document.getElementById("rezultati").innerHTML = data;
                }
            })
        }
    </script>
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
        <h2 class="display-4">Rezultati utakmica:</h2>
    </div>
    <div class="filter">
        <h4 class="h4">Filter</h4>
        <input type="text" id="tim" onkeyup="predloziTim(this.value)">
        <button onclick="prikaziUtakmiceTima()">Prikazi utakmice</button>
        <p class="h6" id="timHint">Predlozi: </p>
    </div>
    <div id="rezultati">
        <?php
            include "models/Rezultat.php";
            include "models/Tim.php";
            
            $data = Rezultat::returnAllData();
            foreach($data as $rezultat){
                $timPrvi = Tim::returnTeamById($rezultat->getPrviTimId());
                $timDrugi = Tim::returnTeamById($rezultat->getDrugiTimId());
                echo "<div class='rezultat'>";
                echo "<form action='rezultati.php' method='post'>";
                echo "<div class='datum'><input type='date' name='datum' value='" . $rezultat->getDatum() . "' readonly style='background: none'></div>";
                echo "<div class='team'>";
                echo "<span class='teamName'><input type='text' name='prvi_tim' value='" . $timPrvi->getIme() . "' readonly style='background: none'></span><span><input type='number' name = 'prviSetova' value='" . $rezultat->getPrviTimSetova() . "' readonly style='background: none'></span>";
                echo "</div>";
                echo "<div class='tim'>";
                echo "<span class='teamName'><input type='text' name='drugi_tim' value='" . $timDrugi->getIme() . "' readonly style='background: none'></span><span><input type='number' name = 'drugiSetova' value='" . $rezultat->getDrugiTimSetova() . "' readonly style='background: none'></span>";
                echo "</div>";
                echo "<div class='dugme'>";
                echo "<input type='submit' name='obrisi' onClick='window.loacation.reload()' value='Obrisi rezultat'>";
                echo "</div>";
                echo "</form>";
                echo "</div>";
            }
        ?>
    </div>
</body>

</html>

<?php

if(isset($_POST['obrisi'])){
    $imePrvog = $_POST['prvi_tim'];
    $imeDrugog = $_POST['drugi_tim'];
    $prviSetova = $_POST['prviSetova'];
    $drugiSetova = $_POST['drugiSetova'];
    $datum = $_POST['datum'];
    $prviTim = Tim::returnTeamByName($imePrvog);
    $drugiTim = Tim::returnTeamByName($imeDrugog);
    if ($prviSetova == 2) {
        if ($drugiSetova == 0) {
            $prviTim->obrisiPobeda20();
            $drugiTim->obrisiPoraz02();
        }
        if ($drugiSetova == 1) {
            $prviTim->obrisiPobeda21();
            $drugiTim->obrisiPoraz12();
        }
    } else if ($prviSetova == 1) {
        $prviTim->obrisiPoraz12();
        $drugiTim->obrisiPobeda21();
    } else {
        $prviTim->obrisiPoraz02();
        $drugiTim->obrisiPobeda20();
    }
    $prviTim->updateTim();
    $drugiTim->updateTim();
    Rezultat::deleteResult($prviTim->getTimId(), $drugiTim->getTimId(), $datum);
    echo $imeDrugog, Tim::returnTeamByName($imeDrugog)->getIme(), $prviTim->getTimId(), $drugiTim->getTimId(), $datum;
    unset($_POST['obrisi']);
    array_push($_SESSION['izmene'], array("izmena" => "brisanje", "prviTim"=>($prviTim->getTimId()), "drugiTim" => ($drugiTim->getTimId()), "prviTimSetova" => $prviSetova, "drugiTimSetova" => $drugiSetova, "datum" => $datum));
    echo "<meta http-equiv='refresh' content='0'>";
}

?>