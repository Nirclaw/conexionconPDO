<?php

namespace App;

class connect extends credential
{
    protected $con;
    function __construct(
        private $dsn = "mysql",
        private $port = 3306
    ) {
        parent::__construct();

        try {
            $this->con = new \PDO($this->dsn . ":host=" . $this->__get('host') . ";dbname=" . $this->__get('dbname') . ";user=" . $this->username . ";password=" . $this->__get('password') . ";port=" . $this->port);
            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $e) {
            print_r($e->getMessage());
        }
   
    }
}
