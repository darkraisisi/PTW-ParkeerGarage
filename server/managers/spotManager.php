<?php
include_once '../db.php';
    class Spot{

        public function getAll(){
            $statement = $con->prepare("SELECT * FROM `plaats`");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAmountFree(){
            $statement = $con->prepare("SELECT count(*) FROM `plaats` WHERE occupied = 'false' ");
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }
        
        public function setSpaceOccupiedState($spotNmr, $level, $state){
            $statement = $con->prepare("UPDATE `plaats` SET `occupied` = :state WHERE `spot_number` = :spotNmr");
            $statement->bindValue(":state",$state);
            $statement->bindValue(":spotNmr",$spotNmr);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }
    }
?>