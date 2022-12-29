<!DOCTYPE html>
<html>

<head>
    <title>Pocetna</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Pocetna</a></li>
            <li>Tabela</li>
            <li>Rezutati</li>
            <li>Timovi</li>
        </ul>
    </nav>
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