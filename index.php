<html>

<head>
    <title>Odbojka</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    <div class="table-repsonsive" id="sport_table">
        <table class="table table-bordered">
            <thead>
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
            var arrow = '';
            if(order == 'desc'){
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';
            } else {
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';
            }
            $.ajax({
                url:"sort.php",
                method:"POST",
                data:{column_name:column_name, order:order},
                success:function(data){
                    $('#sport_table').html(data);
                    $('#'+column_name+' ').append(arrow);
                }
            })
        })
    })
</script>