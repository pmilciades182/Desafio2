<?php
require_once 'Database.php';

class DesafioDos {

    public static function retriveLotes(string $loteID): void {
        Database::setDB();
        echo(json_encode(self::getLotes($loteID)));
    }

    private static function getLotes(string $loteID) {
        $lotes = [];
        $cnx = Database::getConnection();
    
        $stmt = $cnx->prepare("SELECT * FROM debts WHERE lote = ?");
        $stmt->bindValue(1, $loteID, SQLITE3_TEXT);
        $result = $stmt->execute();

        while($rows = $result->fetchArray(SQLITE3_ASSOC)){

            $rows['clientID'] = (int) $rows['clientID'];
            $lotes[] = $rows; 
        }
        return $lotes;
    }
}

DesafioDos::retriveLotes('00148');
