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
        <h2>Trenutno stanje na tabeli:</h2>
    </div>
    <div>
        <table>
            <thead>
                <th>Pozicija</th>
                <th>Tim</th>
                <th>Odigranih utakmica</th>
                <th>Pobeda</th>
                <th>Poraza</th>
                <th>Osvojenih setova</th>
                <th>Izgubljenih setova</th>
                <th>Bodova</th>
            </thead>
            <tbody>
                <?php
                include "models/Tim.php";

                $data = Tim::returnAllData();
                for($i = 1; $i <= count($data); $i++){
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $data[$i - 1]->getIme() . "</td>";
                    echo "<td>" . $data[$i - 1]->getOdigranih() . "</td>";
                    echo "<td>" . $data[$i - 1]->getPobeda() . "</td>";
                    echo "<td>" . $data[$i - 1]->getPoraza() . "</td>";
                    echo "<td>" . $data[$i - 1]->getOsvojenihSetova() . "</td>";
                    echo "<td>" . $data[$i - 1]->getIzgubljenihSetova() . "</td>";
                    echo "<td>" . $data[$i - 1]->getBodova() . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>