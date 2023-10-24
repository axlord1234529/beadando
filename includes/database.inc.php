<?php
    const HOST = 'localhost';
    const DATABASE = 'cukraszda';
    const USER = 'root';
    const PASSWORD = '';

    class Database  {
        private static $_connection = false;

        public static function getConnection()
        {
            if(!self::$_connection)
            {
                self::$_connection = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USER, PASSWORD,
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                self::$_connection->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
            }
            return self::$_connection;
        }
    }