<?php

    include "models/Tim.php";

    $output = "";

    $order = $_POST['order'];
    if($order == 'desc'){
        $order = 'asc';
    } else {
        $order = 'desc';
    }
    $data = Tim::returnAllDataSorted($_POST['column_name'], $order);

    $output .= '
    <table class="table table-bordered">
            <thead>
                <th>Pozicija</th>
                <th><a class="column_sort" id="ime" data-order="'.$order.'" href="#">Tim</a></th>
                <th><a class="column_sort" id="odigranih" data-order="'.$order.'" href="#">Odigranih utakmica</a></th>
                <th><a class="column_sort" id="pobeda" data-order="'.$order.'" href="#">Pobeda</a></th>
                <th><a class="column_sort" id="poraza" data-order="'.$order.'" href="#">Poraza</a></th>
                <th><a class="column_sort" id="osvojenihSetova" data-order="'.$order.'" href="#">Osvojenih setova</a></th>
                <th><a class="column_sort" id="izgubljenihSetova" data-order="'.$order.'" href="#">Izgubljenih setova</a></th>
                <th><a class="column_sort" id="bodova" data-order="'.$order.'" href="#">Bodova</a></th>
            </thead>
            <tbody>';
            for($i = 1; $i <= count($data); $i++){
                $output .= "
                <tr>
                <td>" . $i . "</td>
                <td>" . $data[$i - 1]->getIme() . "</td>
                <td>" . $data[$i - 1]->getOdigranih() . "</td>
                <td>" . $data[$i - 1]->getPobeda() . "</td>
                <td>" . $data[$i - 1]->getPoraza() . "</td>
                <td>" . $data[$i - 1]->getOsvojenihSetova() . "</td>
                <td>" . $data[$i - 1]->getIzgubljenihSetova() . "</td>
                <td>" . $data[$i - 1]->getBodova() . "</td>
                </tr>";
            }
            $output .='
            </tbody>
            </table>
            ';
    echo $output;

?>