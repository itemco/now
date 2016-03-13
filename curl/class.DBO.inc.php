<?php
    
/* My own db-class, hopefully better than the other one! */

class DBO extends Config
{
    private $dbh;
    private $sth;
    private $sql;
    private $valid_keys = array();
    private $validate = array();
    private $valid_types = array();


    public function __construct()
    {
        $this->valid_keys = ["type", "table", "data", "cols", "vals", "where", "sort"];
        $this->validate["SELECT"]["required"] = ["type", "table", "cols"];
        $this->validate["SELECT"]["notvalid"]  = ["vals", "data"];
        $this->validate["DELETE"]["required"] = ["type", "table", "where"];
        $this->validate["DELETE"]["notvalid"]  = ["cols", "vals", "data", "sort"];
        $this->validate["INSERT"]["required"] = ["type", "table", "data"];
        $this->validate["INSERT"]["notvalid"]  = ["cols", "vals", "sort"];
        $this->validate["UPDATE"]["required"] = ["type", "table", "data", "where"];
        $this->validate["UPDATE"]["notvalid"]  = ["cols", "vals", "sort"];
        $this->valid_types = array_keys($this->validate);

        $dsn = "mysql:host=".$this->db_host.";dbname=".$this->db_name;
        $options = [
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ];
        try {
            $this->dbh = new PDO($dsn, $this->db_user, $this->db_pass, $options);
        } catch(Exception $e) {
            echo "ERROR: ".$e->getMessage();
        }
    }

    public function query($sql) {
        $this->sql = $sql;
        try {
            $this->sth = $this->dbh->prepare($sql);
        } catch(Exception $e) {
            echo "ERROR: ".$e->getMessage();
        }
    }

    public function execute() {
        try {
            $result = $this->sth->execute();
        } catch(Exception $e) {
            echo "ERROR: ".$e->getMessage();
        }
        return $result;
    }

    public function resultset() {
        try {
            $result = $this->sth->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            echo "ERROR: ".$e->getMessage();
        }
        return $result;
    }

    public function resultset_group() {
        try {
            $result = $this->sth->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);
        } catch(Exception $e) {
            echo "ERROR: ".$e->getMessage();
        }
        return $result;
    }

    public function single() {
        try {
            $result = $this->sth->fetch(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            echo "ERROR: ".$e->getMessage();
        }
        return $result;
    }

    public function query_with_array($input) {
        if ($this->validate_input_to_query_with_array($input)) {
            $this->sql = $this->build_query_with_array($input);
            $this->sth = $this->dbh->prepare($this->sql);
            $this->bind_with_array($input["data"],":d_");
            $this->bind_with_array($input["where"]);
        }
        return $this->sql;
    }

    public function rowCount() {
        return $this->sth->rowCount();
    }

    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction() {
        return $this->dbh->beginTransaction();
    }

    public function endTransaction() {
        return $this->dbh->commit();
    }

    public function cancelTransaction() {
        return $this->dbh->rollBack();
    }

    public function bind_shit($key, $val) {
        $this->sth->bindValue($key, $val, PDO::PARAM_STR);
    }

    public function bind($key, $value = "", $prefix = ":") {
        try {
            if (is_array($key)) {
                $this->bind_with_array($key);
            } else {
                #only bind if key is present in sql (query)
                #WTF is this? I dont know this->sql here???? Ah this was for GET-statement!
                if (strstr($this->sql, $key)) {
                    #$key = str_replace(":", "", $key); #bad idea, but leave for now
                    $this->sth->bindValue($key, $value, PDO::PARAM_STR);
                    #fnDebug("---".$key."-->--".$value);
                    #$this->sth->bindValue($key, $value, PDO::PARAM_STR); #new version for POST file
                }
            }
        } catch(Exception $e) {
            echo "ERROR: ".$e->getMessage();
        }
    }

    private function bind_with_array($input, $prefix = ":") {
        #should do some validation here, but skip for now
        #array must have keys AND values AND match with created sql
        try {
            if (!empty($input)) {
                foreach ($input as $k=>$v) {
                    $k = str_replace(":", "", $k);
                    $this->sth->bindValue($prefix."".$k, $v, PDO::PARAM_STR);
                }
            }
        } catch(Exception $e) {
            echo "ERROR: ".$e->getMessage();
        }
    }

    private function validate_input_to_query_with_array($input) {
        try {

            #validate array keys allowed
            foreach (array_keys($input) as $key) {
                if (!in_array($key, $this->valid_keys)) {
                    throw new Exception("'".$key."' is not a valid array-key!");
                } else {
                    if (empty($input[$key])) {
                        throw new Exception("Array-key '".$key."' is empty!");
                    }
                }
            }

            #validate type (statement) allowed
            if (isset($input["type"])) {
                $input["type"] = strtoupper($input["type"]);
                if (!in_array($input["type"], $this->valid_types)) {
                    throw new Exception("'".$input["type"]."' is not a valid type (sql-statement)!");
                }
            } else {
                throw new Exception("Array-key 'type' must be specified!");
            }

            #validate required array-keys for type
            $diff = array_diff($this->validate[$input["type"]]["required"], array_keys($input));
            if (!empty($diff)) {
                throw new Exception("Required array-key '".implode("','",$diff)."' not specified!");
            }

            #validate unallowed array-keys for type
            $diff = array_intersect($this->validate[$input["type"]]["notvalid"], array_keys($input));
            if (!empty($diff)) {
                throw new Exception("Unallowed array-key '".implode("','",$diff)."' specified!");
            }

            #could validate contents of each array-key here, but too much hazzle, they final sql-string will fail in DBO if incorrect!

            $result = true;

        } catch(Exception $e) {
            echo "ERROR: ".$e->getMessage()."<br/>";
            $result = false;
        }        

        return $result;
    }

    private function build_query_with_array($input) {
        $sql = "";
        $type = $input["type"];
        $table = $input["table"];
        $data = $input["data"];
        $where = $input["where"];
        $sort = $input["sort"];

        switch ($type) {
            case "SELECT";
                $cols = array_flip($input["cols"]);
                $cols = implode(", ", array_keys($cols));
                $vals = ":".str_replace(", ", ", :", $cols);
                if (!empty($where)) {
                    $temp = array();
                    foreach ($where as $k=>$v) {
                        $temp[] = "$k=:$k";
                    }
                    $where = "WHERE ".implode(" AND ", $temp);
                }
                if (!empty($sort)) {
                    $temp = array();
                    $orderby = "ORDER BY ".implode(", ", $sort);
                }
                $sql = "SELECT $cols FROM $table $where $orderby";
                break;
            case "DELETE";
                $temp = array();
                foreach ($where as $k=>$v) {
                    $temp[] = "$k=:$k";
                }
                $where = "WHERE ".implode(" AND ", $temp);
                $sql = "DELETE FROM $table $where";
                break;
            case "INSERT";
                $cols = implode(", ",array_keys($data));
                $vals = ":d_".str_replace(", ",", :d_",$cols);
                $sql = "INSERT INTO $table ($cols) VALUES ($vals)";
                break;
            case "UPDATE";
                $temp = array();
                foreach ($data as $k=>$v) {
                    $temp[] = "$k=:d_$k";
                }
                $set = "SET ".implode(", ", $temp);
                $temp = array();
                foreach ($where as $k=>$v) {
                    $temp[] = "$k=:$k";
                }
                $where = "WHERE ".implode(" AND ", $temp);
                $sql = "UPDATE $table $set $where";
                break;
        }
        $sql = trim(str_replace("  ", " ", $sql));
        return $sql;
    }

}

?>