<?php

require_once dirname(__FILE__) . "/platform_settings.php";

class Database {

    protected $con;
    protected static $config = array(
        'user' => DB_USER,
        'pass' => DB_PASS,
        'host' => DB_HOST,
        'charset' => 'utf8',
        'dbname' => DB_NAME,
    );

    public static function setConfig(array $params) {
        static::$config = array_intersect_key($params, static::$config) + static::$config;
    }

    public function __construct() {
        $this->con = new PDO(
            sprintf('mysql:dbname=%s;host=%s;charset=%s',
                static::$config['dbname'],
                static::$config['host'],
                static::$config['charset']
            ),
            static::$config['user'],
            static::$config['pass'],
            array(
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/my.cnf', // これがないと文字化けする.
            )
        );
    }

    public function execute($sql, array $params = array()) {
        $stmt = $this->con->prepare($sql);
        foreach ($params as $key => $v) {
            if ( !$v ) $v = array(0=>""); // なんかkey0がないよってwarning出てうざいので.
            list($value, $type) = (array)$v + array(1 => PDO::PARAM_STR);
            $stmt->bindValue(is_int($key) ? ++$key : $key, $value, $type);
        }
        $stmt->execute();
        return $stmt;
    }

}