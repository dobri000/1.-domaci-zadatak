<?php
session_start();
?>

<html>

<head>
    <title>Odbojka</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script>
        $(function() {
            $("#datepicker").datepicker();
        })
    </script>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <ul>
            <li><a href="index.php">Tabela</a></li>
            <li><a href="rezultati.php">Rezutati</a></li>
            <li><a href="unos.php">Unos rezultata</a></li>
            <li><a href="istorija.php">Istorija izmena</a></li>

        </ul>
    </nav>
    <div>
        <h2 class="display-4">Unesite rezultat:</h2>
    </div>
    <form class="formaUnosa" method="post">
        <div>
            <input type="text" id="datepicker" name="datum" placeholder="Datum:">
        </div>
        <div class="unosElementi">
            <select class="form-select" name="prviTim">
                <option value="">Prvi protivnik</option>
                <?php
                include "models/Tim.php";
                $array = Tim::returnAllData();
                foreach ($array as $tim) {
                    echo "<option value=" . $tim->getTimId() . ">" . $tim->getIme() . "</option>";
                }
                echo "</select>";
                echo '<input name="prviTimSetova" type="number" min=0 max=2 value="0">';
                echo '<input name="drugiTimSetova" type="number" min=0 max=2 value="0">';
                echo '<select class="form-select" name="drugiTim">';
                echo '<option value="">Drugi protivnik</option>';
                foreach ($array as $tim) {
                    echo "<option value=" . $tim->getTimId() . ">" . $tim->getIme() . "</option>";
                }
                ?>
            </select>
        </div>
        <div><input type="submit" name="unesi" value="Unesi utakmicu"></div>
        <div class="obavestenje">
            <?php
            //include "models/Tim.php";
            include "models/Rezultat.php";

            if (isset($_POST['unesi'])) {
                $prviTim = $_POST['prviTim'];
                $drugiTim = $_POST['drugiTim'];
                $prviTimSetova = $_POST['prviTimSetova'];
                $drugiTimSetova = $_POST['drugiTimSetova'];
                $datum = $_POST['datum'];
                $dobarRezultat = false;
                if ($datum != '') {
                    if ($prviTim != $drugiTim) {
                        $timPrvi = Tim::returnTeamById($prviTim);
                        $timDrugi = Tim::returnTeamById($drugiTim);
                        if ($prviTimSetova == 2) {
                            if ($drugiTimSetova == 0) {
                                $timPrvi->pobeda20();
                                $timDrugi->poraz02();
                                $dobarRezultat = true;
                            } else if ($drugiTimSetova == 1) {
                                $timPrvi->pobeda21();
                                $timDrugi->poraz12();
                                $dobarRezultat = true;
                            }
                        } else if ($prviTimSetova == 1) {
                            if ($drugiTimSetova == 2) {
                                $timPrvi->poraz12();
                                $timDrugi->pobeda21();
                                $dobarRezultat = true;
                            }
                        } else if ($prviTimSetova == 0 && $drugiTimSetova == 2) {
                            $timPrvi->poraz02();
                            $timDrugi->pobeda20();
                            $dobarRezultat = true;
                        }
                        if ($dobarRezultat) {
                            $timPrvi->updateTim();
                            $timDrugi->updateTim();
                            $rezultat = new Rezultat($prviTim, $drugiTim, $prviTimSetova, $drugiTimSetova, date('Y-m-d', strtotime($datum)));
                            $rezultat->insertResult();
                            echo 'Utakmica je uneta';
                            array_push($_SESSION['izmene'], array("izmena" => "unos", "prviTim" => $prviTim, "drugiTim" => $drugiTim, "prviTimSetova" => $prviTimSetova, "drugiTimSetova" => $drugiTimSetova, "datum" => date('Y-m-d', strtotime($datum))));
                        } else {
                            echo 'Setovi nisu dobro uneti';
                        }
                    } else {
                        echo 'Timovi nisu dobro uneti';
                    }
                } else {
                    echo 'Datum nije unet';
                }
                unset($_POST['unesi']);
            }
            ?>
        </div>
    </form>
</body>


</html>