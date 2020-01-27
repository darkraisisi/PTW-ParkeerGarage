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
            $statement = $con->prepare("SELECT count(*) FROM `parking_spot` WHERE occupation = 'false' AND garage = :garage_id AND `reserve_untill` IS NULL");
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count[0]['count(*)'];
        }
        
        public function getFreeSpacesFromGarage($id){ //Gives you the free spots from a selected garage.
            global $con;
            $statement = $con->prepare("SELECT * FROM `parking_spot` WHERE `occupation` = 0 AND `garage` = :garage_id AND `reserve_untill` IS NULL");
            $statement->bindValue(":garage_id",$id);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $count;
        }

        public function setSpaceOccupiedState(int $garage_id, int $level, int $spotNmr, $state){ //Changes the state of a specific spot.
            global $con;
            $statement = $con->prepare("UPDATE `parking_spot` SET `occupation` = :state, `reserve_untill` = NULL  WHERE `number` = :spotNmr AND `garage` = :garage_id AND `level` = :level");
            $statement->bindValue(":state",$state);
            $statement->bindValue(":spotNmr",$spotNmr);
            $statement->bindValue(":garage_id",$garage_id);
            $statement->bindValue(":level",$level);
            $statement->execute();
            if($statement->rowCount() == 1){
                $ret['succes'] = true;
            }else{
                $ret['succes'] = false;
            }
            return $ret;
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

        public function getRecommendedSpotFromGarage($garage_id){
            global $con;
            $nowDate = new DateTime();
            $nowDate->add(new DateInterval('PT10M'));
            $available = $this->getFreeSpacesFromGarage($garage_id);
            $statement = $con->prepare("UPDATE `parking_spot` SET `reserve_untill` = :time WHERE `parking_spot`.`id` = :spot_id");
            $statement->bindValue(":time",$nowDate->format('yy-m-d H:i:s'));
            $statement->bindValue(":spot_id",intval($available[0]['id']));
            $statement->execute();
            if(count($available) > 0){
                $available[0]['reserve_untill'] = $nowDate->format('yy-m-d H:i:s');
                return $available[0];
            }else{
                $ret['succes'] = false;
            }
        }

    }
?>