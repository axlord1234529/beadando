<?php
require_once 'D:\XAMPP\htdocs\beadando\includes\database.inc.php';
Class Cookies {
    /**
     * @return array
     */
    public function get_cookies() : array
    {
        $result = array('errorCode' => 0,
            'message' => '',
            'cookies' => array());
        try {
            $db = Database::getConnection();
            $sql = "SELECT * FROM suti";

            $sth = $db->prepare($sql);
            $sth->execute();
            $result['cookies'] = $sth->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e)
        {
            $result['errorCode'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * @param string $cookie
     * @return array
     */
    public function get_cookie_content(string $cookie) : array
    {
        $result = array('errorCode' => 0,
            'message' => '',
            'cookie_content' => array());
        try {
            $db = Database::getConnection();
            $sql = "SELECT mentes FROM tartalom AS T INNER JOIN suti AS S ON t.sutiid = S.id WHERE S.nev = '".$cookie."'";

            $sth = $db->prepare($sql);
            $sth->execute();
            $result['cookie_content'] = $sth->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e)
        {
            $result['errorCode'] = 1;
            $result['message'] = $e->getMessage();
        }
        return  $result;
    }

    /**
    * @param string $cookie
    * @return array
    */
    public function get_cookie_price(string $cookie) : array
    {
        $result = array('errorCode' => 0,
            'message' => '',
            'cookie_price' => array());
        try {
            $db = Database::getConnection();
            $sql = "SELECT ertek, egyseg FROM ar AS A INNER JOIN suti AS S ON A.sutiid = S.id WHERE A.id = (SELECT id FROM suti WHERE nev = '".$cookie."')";

            $sth = $db->prepare($sql);
            $sth->execute();
            $result['cookie_price'] = $sth->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e)
        {
            $result['errorCode'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }
}