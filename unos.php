<?php
session_start();
?>

<html>

<head>
    <title>Odbojka</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script>
        $(function(){
            $("#datepicker").datepicker();
        })
    </script>
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
    <form method="post">
        <div><input type="text" id="datepicker" name="datum"></div>
        <div>
            <select name="prviTim">
                <option value="">Prvi protivnik</option>
                <?php
                    include "models/Tim.php";
                    $array = Tim::returnAllData();
                    foreach ($array as $tim){
                        echo "<option value=".$tim->getTimId().">".$tim->getIme()."</option>";
                    }
            echo "</select>";
            echo '<input name="prviTimSetova" type="number" min=0 max=2 value="0">';
            echo '<input name="drugiTimSetova" type="number" min=0 max=2 value="0">';
            echo '<select name="drugiTim">';
            echo '<option value="">Drugi protivnik</option>';
                    foreach ($array as $tim){
                        echo "<option value=".$tim->getTimId().">".$tim->getIme()."</option>";
                    }
                ?>
            </select>
        </div>
        <div><input type="submit" name="unesi" value="Unesi utakmicu"></div>
        <div>
            <?php
            //include "models/Tim.php";
            include "models/Rezultat.php";

            if (isset($_POST['unesi'])) {
                $prviTim = $_POST['prviTim'];
                $drugiTim = $_POST['drugiTim'];
                $prviTimSetova = $_POST['prviTimSetova'];
                $drugiTimSetova = $_POST['drugiTimSetova'];
                $datum = $_POST['datum'];
                if ($prviTim != $drugiTim) {
                    $timPrvi = Tim::returnTeamById($prviTim);
                    $timDrugi = Tim::returnTeamById($drugiTim);
                    if ($prviTimSetova == 2) {
                        if ($drugiTimSetova == 0) {
                            $timPrvi->pobeda20();
                            $timDrugi->poraz02();
                        }
                        if ($drugiTimSetova == 1) {
                            $timPrvi->pobeda21();
                            $timDrugi->poraz12();
                        }
                    } else if ($prviTimSetova == 1) {
                        $timPrvi->poraz12();
                        $timDrugi->pobeda21();
                    } else {
                        $timPrvi->poraz02();
                        $timDrugi->pobeda20();
                    }
                    $timPrvi->updateTim();
                    $timDrugi->updateTim();
                    $rezultat = new Rezultat($prviTim, $drugiTim, $prviTimSetova, $drugiTimSetova, date('Y-m-d', strtotime($datum)));
                    $rezultat->insertResult();
                    echo 'Utakmica je uneta';
                    unset($_POST['unesi']);
                    array_push($_SESSION['izmene'], array("izmena" => "unos", "prviTim"=>$prviTim, "drugiTim" => $drugiTim, "prviTimSetova" => $prviTimSetova, "drugiTimSetova" => $drugiTimSetova, "datum" => date('Y-m-d', strtotime($datum))));
                } else {
                    echo 'Timovi treba da budu razliciti';
                }
            }
            ?>
        </div>
    </form>
</body>


</html>