<?php

    

    class Rezultat{
        private $prviTimId;
        private $drugiTimId;
        private $prviTimSetova;
        private $drugiTimSetova;
        private $datum;

        public function __construct($prviTimId, $drugiTimId, $prviTimSetova, $drugiTimSetova, $datum){
            $this->prviTimId = $prviTimId;
            $this->drugiTimId = $drugiTimId;
            $this->prviTimSetova = $prviTimSetova;
            $this->drugiTimSetova = $drugiTimSetova;
            $this->datum = $datum;
        }

        public function getPrviTimId(){
            return $this->prviTimId;
        }

        public function getDrugiTimId(){
            return $this->drugiTimId;
        }

        public function getPrviTimSetova(){
            return $this->prviTimSetova;
        }

        public function getDrugiTimSetova(){
            return $this->drugiTimSetova;
        }

        public function getDatum(){
            return $this->datum;
        }

        public function insertResult(){
            include "connection.php";

            $stmt = $conn->prepare("insert into rezultat values (?,?,?,?,?)");
            $stmt->bind_param("iiiis", $this->prviTimId, $this->drugiTimId, $this->prviTimSetova, $this->drugiTimSetova, $this->datum);
            $stmt->execute();
        }

        public static function returnAllData(){
            include "connection.php";

            $rezultatArray = array();
            $data = $conn->query("select * from rezultat order by datum desc");

            while($row = $data->fetch_assoc()){
                $rezultat = new Rezultat($row["prviTimId"], $row["drugiTimId"], $row["prviTimSetova"], $row["drugiTimSetova"], $row["datum"]);
                array_push($rezultatArray, $rezultat);
            }

            return $rezultatArray;
        }

    }

?>