<?php
class Database

{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $pdo;
    private $stmt;
    private $error;

    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false // For General Error
        );

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
            // print_r($this->pdo);
            // echo "Success";
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function create($table, $data)
    {
        // print_r($data);
        // exit;
        try {
            $column = array_keys($data);
            $columnSql = implode(', ', $column);
            $bindingSql = ':' . implode(',:', $column);
            $table = '`' . $table . '`';
            // echo $bindingSql;
            // exit;
            $sql = "INSERT INTO $table ($columnSql) VALUES ($bindingSql)";
            // echo $sql;
            // exit;
            $stm = $this->pdo->prepare($sql);
            foreach ($data as $key => $value) {
                $stm->bindValue(':' . $key, $value);
            }
            // print_r($stm);
            // exit;
            $status = $stm->execute();
            // print($status);
            // exit;
            // echo $status;
            return ($status) ? $this->pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // Update Query
    public function update($table, $id, $data)
    {
        // First, we don't want id from category table
        if (isset($data['id'])) {
            unset($data['id']);
        }

        try {
            $columns = array_keys($data);
            function map($item)
            {
                return $item . '=:' . $item;
            }
            $columns = array_map('map', $columns);
            $bindingSql = implode(',', $columns);
            // echo $bindingSql;
            // exit;
            $sql = 'UPDATE ' .  $table . ' SET ' . $bindingSql . ' WHERE `id` =:id';
            $stm = $this->pdo->prepare($sql);

            // Now, we assign id to bind
            $data['id'] = $id;

            foreach ($data as $key => $value) {
                $stm->bindValue(':' . $key, $value);
            }
            $status = $stm->execute();
            // print_r($status);
            return $status;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function delete($table, $id)
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE `id` = :id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        return ($success);
    }

    public function columnFilter($table, $column, $value)
    {
        // $sql = 'SELECT * FROM ' . $table . ' WHERE `' . $column . '` = :value';
        $sql = 'SELECT * FROM ' . $table . ' WHERE `' . str_replace('`', '', $column) . '` = :value';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':value', $value);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function loginCheck($email, $password)
    {
        $sql = 'SELECT * FROM users WHERE `email` = :email AND `password` = :password';

        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':password', $password);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);

        return ($success) ? $row : [];
    }

    public function setLogin($id)
    {
        $sql = 'UPDATE users SET `is_login` = :value WHERE `id` = :id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':value', 1);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $stm->closeCursor();    // to solve PHP Unbuffered Queries
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function unsetLogin($id)
    {
        try {
            $sql        = "UPDATE users SET is_login = :false WHERE id = :id";
            $stm        = $this->pdo->prepare($sql);
            $stm->bindValue(':false', '0');
            $stm->bindValue(':id', $id);
            $success = $stm->execute();
            $row     = $stm->fetch(PDO::FETCH_ASSOC);
            return ($success) ? $row : [];
        } catch (Exception $e) {
            echo ($e);
        }
    }

    public function readAll($table)
    {
        $sql = 'SELECT * FROM ' . $table;
        // print_r($sql);
        // exit;
        $stm = $this->pdo->prepare($sql);
        $success = $stm->execute();
        if ($success == true) {
            print_r($success);
        }
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);

        return ($success) ? $row : [];
    }

    public function getById($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `id` =:id';
        // print_r($sql);
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }
    public function getByIdAll($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `user_Id` =:id';
        // print_r($sql);
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByIdView($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `order_Id` =:id';
        // print_r($sql);
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByPriceId($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE `deliveryPrice_ID` =:id';
        // print_r($sql);
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByCategoryId($table, $column)
    {
        $stm = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE name =:column');
        $stm->bindValue(':column', $column);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        //  print_r($row);
        return ($success) ? $row : [];
    }

    public function getByAddressId($table, $key, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $key . ' =:' . $key;
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':' . $key, $id);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByCompanyName($table, $key, $companyName)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $key . ' =:' . $key;
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':' . $key, $companyName);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }
    public function getPriceByAddressNameAndCompanyName($table, $key1, $value1, $key2, $value2)
    {
        $sql = "SELECT * FROM $table WHERE $key1 = :value1 AND $key2 = :value2";
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':value1', $value1);
        $stm->bindValue(':value2', $value2);
        $success = $stm->execute();
        $rows = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $rows : [];
    }

    public function getAddressId($table, $street_id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE  street_id =:street_id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':street_id', $street_id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return $success ? $row : [];
    }



    public function getAddressByUserId($table, $user_id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE  user_id =:user_id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':user_id', $user_id);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return $success ? $row : [];
    }

    public function getByEmail($table, $email)
    {
        // echo $table, $email;

        $sql = 'SELECT * FROM ' . $table . ' WHERE email =:email';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':email', $email);
        $success = $stm->execute();
        $row = $stm->fetchAll(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    public function getByUserAddress($table, $address)
    {
        // echo $table, $email;

        $sql = 'SELECT * FROM ' . $table . ' WHERE user_address =:id';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':id', $address);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }



    public function getBySessionEmail($table, $email)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE email =:email';
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(':email', $email);
        $success = $stm->execute();
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return ($success) ? $row : [];
    }

    // For Dashboard
    public function incomeTransition()
    {
        try {

            $sql  = "SELECT *,SUM(amount) AS amount FROM incomes WHERE
           (date = { fn CURDATE() }) ";
            $stm = $this->pdo->prepare($sql);
            $success = $stm->execute();

            $row     = $stm->fetch(PDO::FETCH_ASSOC);
            return ($success) ? $row : [];
        } catch (Exception $e) {
            echo ($e);
        }
    }

    public function expenseTransition()
    {
        try {

            $sql        = "SELECT * ,SUM(amount*qty) AS amount FROM expenses WHERE
           (date = { fn CURDATE() }) ";
            $stm = $this->pdo->prepare($sql);
            $success = $stm->execute();

            $row     = $stm->fetch(PDO::FETCH_ASSOC);
            return ($success) ? $row : [];
        } catch (Exception $e) {
            echo ($e);
        }
    }
}
