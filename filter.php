<?php

    	    include "models/Rezultat.php";
            include "models/Tim.php";
            
$output = "";


            $data = Rezultat::returnTeamResults(Tim::returnIdByName($_POST["name"]));
            foreach($data as $rezultat){
                $timPrvi = Tim::returnTeamById($rezultat->getPrviTimId());
                $timDrugi = Tim::returnTeamById($rezultat->getDrugiTimId());
                $output .= "<div class='rezultat'>";
                $output .= "<form action='rezultati.php' method='post'>";
                $output .= "<div class='datum'><input type='date' name='datum' value='" . $rezultat->getDatum() . "' readonly style='background: none'></div>";
                $output .= "<div class='team'>";
                $output .= "<span class='teamName'><input type='text' name='prvi_tim' value='" . $timPrvi->getIme() . "' readonly style='background: none'></span><span><input type='number' name = 'prviSetova' value='" . $rezultat->getPrviTimSetova() . "' readonly style='background: none'></span>";
                $output .= "</div>";
                $output .= "<div class='tim'>";
                $output .= "<span class='teamName'><input type='text' name='drugi_tim' value='" . $timDrugi->getIme() . "' readonly style='background: none'></span><span><input type='number' name = 'drugiSetova' value='" . $rezultat->getDrugiTimSetova() . "' readonly style='background: none'></span>";
                $output .= "</div>";
                $output .= "<div class='dugme'>";
                $output .= "<input type='submit' name='obrisi' onClick='window.loacation.reload()' value='Obrisi rezultat'>";
                $output .= "</div>";
                $output .= "</form>";
                $output .= "</div>";
            }

            echo $output;
            
?>