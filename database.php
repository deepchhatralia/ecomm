<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "ecommerce";
    private $conn = "";

    private $connection = false;

    public function __construct()
    {
        if (!$this->connection) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);
            $this->connection = true;

            if ($this->conn->connect_error) {
                return false;
            }
            return true;
        } else {
            return true;
        }
    }

    public function connection()
    {
        return $this->conn;
    }

    public function select($columns = "*", $table, $where = null, $order = null, $limit = null)
    {
        if ($this->tableExists($table)) {
            $sql = "SELECT $columns FROM `$table`";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($order != null) {
                $sql .= " ORDER BY $order";
            }
            if ($limit != null) {
                $sql .= " LIMIT 0,$limit";
            }

            $query = $this->conn->query($sql);

            if ($query) {
                return $query;
            }
            return false;
        } else {
            echo 'Table does not exist';
        }
    }

    // This function takes whole query as a parameter
    public function sql($sql)
    {
        $query = $this->conn->query($sql);
        if ($query) {
            $x = array();
            $x = $query->fetch_all(MYSQLI_ASSOC);
            echo '<pre>';
            print_r($x);
            echo '</pre>';
        }
    }

    public function insert($table, $params = array())
    {
        $table_columns = implode(', ', array_keys($params));
        $table_values = implode("','", $params);

        if ($this->tableExists($table)) {
            $sql = "INSERT INTO `$table`($table_columns) VALUES('$table_values')";

            if ($this->conn->query($sql)) {
                return true;
            }
            return false;
        } else {
            echo 'Table does not exist';
        }
    }

    public function update($table, $params = array(), $where = null)
    {
        if ($this->tableExists($table)) {
            $args = array();

            foreach ($params as $key => $value) {
                $args[] = "$key = '$value'";
            }
            $args = implode(", ", $args);

            $sql = "UPDATE `$table` SET $args";

            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->conn->query($sql)) {
                return true;
            }
            return false;
            // return mysqli_error($this->connection());
        } else {
            echo 'Table does not exist';
        }
    }

    public function delete($table, $where = null)
    {
        if ($this->tableExists($table)) {
            $sql = "DELETE FROM `$table`";

            if ($where) {
                $sql .= " WHERE $where ";
            }
            $result = $this->conn->query($sql);
            if ($result) {
                return true;
            }
            return false;
            // return mysqli_error($this->connection());
        } else {
            echo 'Table does not exits';
        }
    }

    private function tableExists($table)
    {
        $sql = "SHOW TABLES FROM $this->db LIKE '$table'";
        $tableInDb = $this->conn->query($sql);
        if ($tableInDb) {
            if ($tableInDb->num_rows == 1) {
                return true; // The table exists
            }
            return false;
        }
    }

    public function __destruct()
    {
        if ($this->connection) {
            $this->connection = false;
            $this->conn->close();
        }
    }
}
