<?php 

namespace src\utils;

use PDO;

class Database {

    public PDO $pdo;


    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=myschoollodge', 'root', '');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    }

    public function executeQuery($sql, $params = []) {
        
        $statement = $this->pdo->prepare($sql);
        if($statement->execute($params)) {
            return ['count' => $statement->rowCount(), 'data' => $statement->fetchAll(PDO::FETCH_ASSOC), 'single-data' => $statement->fetch()];
        }
        return false;
    }
}
