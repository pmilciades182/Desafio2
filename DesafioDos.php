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
        // Corregir la query: remover LIMIT 2 y usar parámetros preparados para evitar SQL injection
        $stmt = $cnx->prepare("SELECT * FROM debts WHERE lote = ?");
        $stmt->bindValue(1, $loteID, SQLITE3_TEXT);
        $result = $stmt->execute();

        while($rows = $result->fetchArray(SQLITE3_ASSOC)){
            // Convertir clientID a entero como espera el JSON
            $rows['clientID'] = (int) $rows['clientID'];
            $lotes[] = $rows; // Devolver como array, no como objeto
        }
        return $lotes;
    }
}

DesafioDos::retriveLotes('00148');
