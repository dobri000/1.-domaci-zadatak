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
    <div>
        <h2>Rezultati utakmica:</h2>
    </div>
    <div>
        <?php
            include "models/Rezultat.php";
            include "models/Tim.php";
            
            $data = Rezultat::returnAllData();
            foreach($data as $rezultat){
                $timPrvi = Tim::returnThisTeam($rezultat->getPrviTimId());
                $timDrugi = Tim::returnThisTeam($rezultat->getDrugiTimId());
                echo "<div class='rezultat'>";
                echo "<form method='post'>";
                echo "<div>" . $rezultat->getDatum() . "</div>";
                echo "<div>";
                echo "<span>" . $timPrvi->getIme() . ": </span><span>" . $rezultat->getPrviTimSetova() . "</span>";
                echo "</div>";
                echo "<div>";
                echo "<span>" . $timDrugi->getIme() . ": </span><span>" . $rezultat->getDrugiTimSetova() . "</span>";
                echo "</div>";
                echo "</form>";
                echo "</div>";
            }
        ?>
    </div>
</body>

</html>