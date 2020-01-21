<?php
include_once 'database/db.php';
    class Spot{

        public function _construct(){
            global $con;
            var_dump($con);
            $this->con = $con;
        } 

        public function getAll(){
            $statement = $this->con->prepare("SELECT * FROM `plaats`");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAmountFree(){
            $statement = $this->con->prepare("SELECT count(*) FROM `plaats` WHERE occupied = 'false' ");
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }

        public function getFreeSpaces(){
            $statement = $this->con->prepare("SELECT * FROM `plaats` WHERE occupied = 'false' ");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function setSpaceOccupiedState(int $spotNmr, int $level, bool $state){
            $statement = $this->con->prepare("UPDATE `plaats` SET `occupied` = :state WHERE `spot_number` = :spotNmr");
            $statement->bindValue(":state",$state);
            $statement->bindValue(":spotNmr",$spotNmr);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }
    }