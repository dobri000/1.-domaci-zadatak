<?php
session_start();
?>

<html>

<head>
    <title>Odbojka</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="background-image: url(./img/background.jpg); background-repeat: no-repeat; background-size: cover;">
    <?php
        if(!isset($_SESSION['izmene'])){
            $_SESSION['izmene'] = array();
        }
    ?>
    <nav class="navbar navbar-dark bg-dark">
        <ul>
            <li><a href="index.php">Tabela</a></li>
            <li><a href="rezultati.php">Rezutati</a></li>
            <li><a href="unos.php">Unos rezultata</a></li>
            <li><a href="istorija.php">Istorija izmena</a></li>

        </ul>
    </nav>
    <div>
        <h2 class="display-4">Trenutno stanje na tabeli:</h2>
    </div>
    <div class="table-repsonsive" id="sport_table">
        <table class="table">
            <thead class="table-dark">
                <th>Pozicija</th>
                <th><a class="column_sort" id="ime" data-order="asc" href="#">Tim</a></th>
                <th><a class="column_sort" id="odigranih" data-order="desc" href="#">Odigranih utakmica</a></th>
                <th><a class="column_sort" id="pobeda" data-order="desc" href="#">Pobeda</a></th>
                <th><a class="column_sort" id="poraza" data-order="asc" href="#">Poraza</a></th>
                <th><a class="column_sort" id="osvojenihSetova" data-order="desc" href="#">Osvojenih setova</a></th>
                <th><a class="column_sort" id="izgubljenihSetova" data-order="asc" href="#">Izgubljenih setova</a></th>
                <th><a class="column_sort" id="bodova" data-order="asc" href="#">Bodova</a></th>
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
<script>
    $(document).ready(function(){
        $(document).on('click', '.column_sort', function(){
            var column_name = $(this).attr("id");
            var order = $(this).data("order");
            $.ajax({
                url:"sort.php",
                method:"POST",
                data:{column_name:column_name, order:order},
                success:function(data){
                    $('#sport_table').html(data);
                }
            })
        })
    })
</script>