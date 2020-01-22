<?php
include_once 'database/db.php';
    class Spot{

        public function getAllFromGarage($id){
            global $con;
            $statement = $con->prepare("SELECT * FROM `parking_spot` WHERE garage = :garage_id" );
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAmountFreeFromGarage($id){
            global $con;
            $statement = $con->prepare("SELECT count(*) FROM `parking_spot` WHERE occupation = 'false' AND garage = :garage_id");
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }
        
        public function setSpaceOccupiedState($spotNmr, $level, $state){
            global $con;
            $statement = $con->prepare("UPDATE `parking_spot` SET `occupation` = :state WHERE `number` = :spotNmr");
            $statement->bindValue(":state",$state);
            $statement->bindValue(":spotNmr",$spotNmr);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }

        public function getAmountOccupiedFromGarage($id){
            global $con;
            $statement = $con->prepare("SELECT count(*) FROM `parking_spot` WHERE occupation = 'true' AND garage = :garage_id");
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }

        public function getParkinglots(){
            global $con;
            $statement = $con->prepare("SELECT * FROM `parking_garage`");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        }
    }
?>