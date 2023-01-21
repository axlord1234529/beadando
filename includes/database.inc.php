<?php
    const HOST = 'sql110.epizy.com';
    const DATABASE = 'epiz_33429737_cukraszda';
    const USER = 'epiz_33429737';
    const PASSWORD = 'x5Sq6isPz0ETr';

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