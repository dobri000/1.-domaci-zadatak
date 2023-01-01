<html>

<head>
    <title>Odbojka</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Tabela</a></li>
            <li><a href="rezultati.php">Rezutati</a></li>
            <li><a href="unos.php">Unos rezultata</a></li>
        </ul>
    </nav>
    <form method="post">
        <div><input type="date" name="datum"></div>
        <div>
            <select name="prviTim">
                <option value=1>Fakultet organizacionih nauka</option>
                <option value=2>Elektrotehnicki fakultet</option>
                <option value=3>Fakultet sporta i fizickog vaspitanja</option>
                <option value=4>ATUSS</option>
                <option value=5>Stomatoloski fakultet</option>
                <option value=6>Medicinski fakultet</option>
                <option value=7>Ekonomski fakultet</option>
            </select>
            <input name="prviTimSetova" type="number" min=0 max=2 value="0">
            <input name="drugiTimSetova" type="number" min=0 max=2 value="0">
            <select name="drugiTim">
                <option value=1>Fakultet organizacionih nauka</option>
                <option value=2>Elektrotehnicki fakultet</option>
                <option value=3>Fakultet sporta i fizickog vaspitanja</option>
                <option value=4>ATUSS</option>
                <option value=5>Stomatoloski fakultet</option>
                <option value=6>Medicinski fakultet</option>
                <option value=7>Ekonomski fakultet</option>
            </select>
        </div>
        <div><input type="submit" name="unesi" value="Unesi utakmicu"></div>
        <div>
            <?php
            include "models/Tim.php";
            include "models/Rezultat.php";

            if (isset($_POST['unesi'])) {
                $prviTim = $_POST['prviTim'];
                $drugiTim = $_POST['drugiTim'];
                $prviTimSetova = $_POST['prviTimSetova'];
                $drugiTimSetova = $_POST['drugiTimSetova'];
                $datum = $_POST['datum'];
                if ($prviTim != $drugiTim) {
                    $timPrvi = Tim::returnThisTeam($prviTim);
                    $timDrugi = Tim::returnThisTeam($drugiTim);
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
                    //$timPrvi->updateTim();
                    //$timDrugi->updateTim();
                    $rezultat = new Rezultat($prviTim, $drugiTim, $prviTimSetova, $drugiTimSetova, date('Y-m-d', strtotime($datum)));
                    $rezultat->insertResult();
                    echo 'Utakmica je uneta';
                    unset($_POST['unesi']);
                } else {
                    echo 'Timovi treba da budu razliciti';
                }
            }
            ?>
        </div>
    </form>
</body>


</html>