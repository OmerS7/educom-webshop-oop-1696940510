<?php

class Crud {

    private $pdo;

    private function connectDatabase() {
        $server = "localhost";
        $username = "omer_web_shop_user";
        $password = "educom123!";
        $database = "omer_webshop";
        $connectionString = "mysql:server= localhost;database=mydb";

        $this->pdo = new PDO($connectionString, $username, $password);
        $this->pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function createRow($sql, $params=[]) {
        $this->connectDatabase();
        
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue(":" . $key, $value);
            }
            $stmt->execute();
            $result = $this->pdo->lastInsertId();
            return $result;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function readOneRow($sql, $params=[]) {
        $this->connectDatabase();
        
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue(":" . $key, $value);
            }
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function readManyRows($sql, $params=[], $bindId = false) {
        $this->connectDatabase();
        
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue(":" . $key, $value);
            }
            $stmt->execute();

            if ($bindId == true) {
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $result[$row->id] = $row;
                }
            } else {
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            return $result;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateRow($sql, $params=[]) {
        $this->connectDatabase();

        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue(":" . $key, $value);
            }
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function deleteRow($sql, $params=[]) {
        $this->connectDatabase();

        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue(":" . $key, $value);
            }
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}

?>