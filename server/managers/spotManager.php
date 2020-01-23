<?php
include_once 'database/db.php';
    class Spot{

        public function getAllFromGarage($id){ //Gets all the information about parking spots from a selected garage.
            global $con;
            $statement = $con->prepare("SELECT * FROM `parking_spot` WHERE garage = :garage_id" );
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAmountFreeFromGarage($id){ //Gives you the number of free spots from a selected garage.
            global $con;
            $statement = $con->prepare("SELECT count(*) FROM `parking_spot` WHERE occupation = 'false' AND garage = :garage_id");
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }
        
        public function getFreeSpacesFromGarage($id){ //Gives you the free spots from a selected garage.
            global $con;
            $statement = $con->prepare("SELECT * FROM `plaats` WHERE occupied = 'false' AND garage = :garage_id ");
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }

        public function setSpaceOccupiedState($spotNmr, $level, $state){ //Changes the state of a specific spot.
            global $con;
            $statement = $con->prepare("UPDATE `parking_spot` SET `occupation` = :state WHERE `number` = :spotNmr");
            $statement->bindValue(":state",$state);
            $statement->bindValue(":spotNmr",$spotNmr);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }

        public function getAmountOccupiedFromGarage($id){ //Gives you the amount of occupied spots from a selected garage.
            global $con;
            $statement = $con->prepare("SELECT * FROM `parking_spot` WHERE occupation = 'true' AND garage = :garage_id");
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }

        public function getOccupiedFromGarage($id){ //Gives you the occupied spots from a selected garage.
            global $con;
            $statement = $con->prepare("SELECT count(*) FROM `parking_spot` WHERE occupation = 'true' AND garage = :garage_id");
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }

        public function getParkingGarages(){ //Gives you all the information about garages.
            global $con;
            $statement = $con->prepare("SELECT * FROM `parking_garage`");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        }

        public function getAmountParkingLotsFromGarage($id){ //Gives you the amount of spots from a selected garage.
            global $con;
            $statement = $con->prepare("SELECT count('number') FROM `parking_spot` WHERE garage = :garage_id");
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0];
        }

    }
?>