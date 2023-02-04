<?php

    

    class Tim{
        private $timId;
        private $ime;
        private $odigranih;
        private $pobeda;
        private $poraza;
        private $osvojenihSetova;
        private $izgubljenihSetova;
        private $bodova;


        public function __construct($timId, $ime, $odigranih, $pobeda, $poraza, $osvojenihSetova, $izgubljenihSetova, $bodova)
        {
            $this->timId = $timId;
            $this->ime = $ime;
            $this->odigranih = $odigranih;
            $this->pobeda = $pobeda;
            $this->poraza = $poraza;
            $this->osvojenihSetova = $osvojenihSetova;
            $this->izgubljenihSetova = $izgubljenihSetova;
            $this->bodova = $bodova;
        }

        
        public function setTimId($timId){
            $this->timId = $timId;
        }

        public function getTimId(){
            return $this->timId;
        }

        public function setIme($ime){
            $this->ime = $ime;
        }

        public function getIme(){
            return $this->ime;
        }
        
        public function setOdigranih($odigranih){
            $this->odigranih = $odigranih;
        }

        public function getOdigranih(){
            return $this->odigranih;
        }

        public function setPobeda($pobeda){
            $this->pobeda = $pobeda;
        }

        public function getPobeda(){
            return $this->pobeda;
        }

        public function setPoraza($poraza){
            $this->poraza = $poraza;
        }

        public function getPoraza(){
            return $this->poraza;
        }

        public function setOsvojenihSetova($osvojenihSetova){
            $this->osvojenihSetova = $osvojenihSetova;
        }

        public function getOsvojenihSetova(){
            return $this->osvojenihSetova;
        }

        public function setIzgubljenihSetova($izgubljenihSetova){
            $this->izgubljenihSetova = $izgubljenihSetova;
        }

        public function getIzgubljenihSetova(){
            return $this->izgubljenihSetova;
        }

        public function setBodova($bodova){
            $this->bodova = $bodova;
        }

        public function getBodova(){
            return $this->bodova;
        }

        public function pobeda20(){
            $this->pobeda++;
            $this->odigranih++;
            $this->osvojenihSetova += 2;
            $this->bodova += 3;
        }

        public function obrisiPobeda20(){
            $this->pobeda--;
            $this->odigranih--;
            $this->osvojenihSetova -= 2;
            $this->bodova -= 3;
        }

        public function pobeda21(){
            $this->pobeda++;
            $this->odigranih++;
            $this->osvojenihSetova += 2;
            $this->bodova += 2;
            $this->izgubljenihSetova++;
        }

        public function obrisiPobeda21(){
            $this->pobeda--;
            $this->odigranih--;
            $this->osvojenihSetova -= 2;
            $this->bodova -= 2;
            $this->izgubljenihSetova--;
        }

        public function poraz02(){
            $this->poraza++;
            $this->odigranih++;
            $this->izgubljenihSetova += 2;
        }

        public function obrisiPoraz02(){
            $this->poraza--;
            $this->odigranih--;
            $this->izgubljenihSetova -= 2;
        }

        public function poraz12(){
            $this->poraza++;
            $this->odigranih++;
            $this->osvojenihSetova += 1;
            $this->bodova += 1;
            $this->izgubljenihSetova += 2;
        }

        public function obrisiPoraz12(){
            $this->poraza--;
            $this->odigranih--;
            $this->osvojenihSetova -= 1;
            $this->bodova -= 1;
            $this->izgubljenihSetova -= 2;
        }

        public function updateTim(){
            include "connection.php";


            $stmt = $conn->prepare("update tim set odigranih = ?, pobeda = ?, poraza = ?, osvojenihSetova = ?, izgubljenihSetova = ?, bodova = ? where timId = ?");
            $stmt->bind_param("iiiiiii", $this->odigranih, $this->pobeda, $this->poraza, $this->osvojenihSetova, $this->izgubljenihSetova, $this->bodova, $this->timId);
            $stmt->execute();

        }

        public static function returnAllData(){
            include "connection.php";

            $timArray = array();
            $data = $conn->query("select * from tim order by pobeda desc, bodova desc, osvojenihSetova - izgubljenihSetova desc, osvojenihSetova desc, izgubljenihSetova asc");

            while($row = $data->fetch_assoc()){
                $tim = new Tim($row["timId"], $row["ime"], $row["odigranih"], $row["pobeda"], $row["poraza"], $row["osvojenihSetova"], $row["izgubljenihSetova"], $row["bodova"]);
                array_push($timArray, $tim);
            }

            return $timArray;
        }

        public static function returnTeamById($timId){
            include "connection.php";


            $stmt = $conn->prepare("select * from tim where timId = ?");
            $stmt->bind_param("i", $timId);
            $stmt->execute();

            $data = $stmt->get_result();

            $row = $data->fetch_assoc();

            return new Tim($row["timId"], $row["ime"], $row["odigranih"], $row["pobeda"], $row["poraza"], $row["osvojenihSetova"], $row["izgubljenihSetova"], $row["bodova"]);
        }

        public static function returnTeamByName($ime){
            include "connection.php";


            $stmt = $conn->prepare("select * from tim where ime = ?");
            $stmt->bind_param("s", $ime);
            $stmt->execute();

            $data = $stmt->get_result();

            $row = $data->fetch_assoc();

            return new Tim($row["timId"], $row["ime"], $row["odigranih"], $row["pobeda"], $row["poraza"], $row["osvojenihSetova"], $row["izgubljenihSetova"], $row["bodova"]);
        }

        public static function returnIdByName($ime){
            include "connection.php";


            $stmt = $conn->prepare("select timId from tim where lower(ime) = ?");
            $stmt->bind_param("s", $ime);
            $stmt->execute();

            $data = $stmt->get_result();

            $row = $data->fetch_assoc();

            return $row["timId"];
        }
        
        public static function returnAllDataSorted($column_name, $order){
            include "connection.php";

            $timArray = array();
            $data = $conn->query("select * from tim order by ".$column_name." ".$order);

            while($row = $data->fetch_assoc()){
                $tim = new Tim($row["timId"], $row["ime"], $row["odigranih"], $row["pobeda"], $row["poraza"], $row["osvojenihSetova"], $row["izgubljenihSetova"], $row["bodova"]);
                array_push($timArray, $tim);
            }

            return $timArray;
        }

        public static function returnNameSuggest($str){
            include "connection.php";

            $data = $conn->query("select ime from tim where lower(ime) like '".strtolower($str)."%'");

            $array = array();
            while($row = $data->fetch_assoc()){ 
                array_push($array, $row["ime"]);
            }

            return $array;
        }

    }
