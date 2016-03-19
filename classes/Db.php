<?php

namespace app\classes;

class Db {

    /********* Подключаемся к БД и выполняем запрос *********/
    
    protected $dbh;
    protected $config='';

    public function __construct(){

        $this->config = include __DIR__ . '/../config/db.php';
        $dsn = 'mysql:dbname=' . $this->config['dbname'] . ';host=' . $this->config['host'];
		try {
            $this->dbh = new \PDO($dsn, $this->config['user'], $this->config['password']);
        } catch (\PDOException $mess){
             die('Connection to the database failed!');
       }

    }


    public function execute($sql, $params=[], $ins=0){
       
        if ($params){
           
            $this->dbh->prepare($sql)->execute($params);

        } else {
            if ($result = $this->dbh->query($sql)){
                return $result->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                $sqlCreateTable = "CREATE TABLE IF NOT EXISTS ".$this->config['table']." (
                           `name` varchar(222) NOT NULL,
                           `status` boolean NOT NULL
                         ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                        ";
                        
                $sqlCreateLoadToTable = "
                        LOAD DATA INFILE '".__DIR__ ."/../file.csv'
                        INTO TABLE ".$this->config['table']."
                        FIELDS TERMINATED BY ';' 
                        ENCLOSED BY ''
                        LINES TERMINATED BY '\\n'
                        IGNORE 1 ROWS;
                            ";
                          
                 return ( $this->dbh->query($sqlCreateTable) && 
                    $this->dbh->query($sqlCreateLoadToTable) ) ? $this->dbh->query($sql)->fetchAll(\PDO::FETCH_ASSOC) : false;
            }
        }
    }
}