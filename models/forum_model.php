<?php
class Forum_model
{
    private bool|PDO $_db;

    public function __construct(){
        $this->_db = Database::getConnection();
    }
    public function get_data($vars) : array
    {
        $retData = array();

        if(isset($vars['post-title']) && isset($vars['post-text']) && isset($vars['post-date']))
        {
            $retData['uploded'] = $this->upload_post($vars['post-title'], $vars['post-text'], $vars['post-date'],$_SESSION['userid']);
        }
        if(isset($vars['comment-text']))
        {
           $retData['comment'] =  $this->upload_comment($vars['comment-text'],$vars['comment-post'], $vars['comment-date'],$_SESSION['userid']);
        }
        $posts = $this->get_posts();
        if($posts['errorCode'] == 0)
        {
            $retData['posts'] = $posts['posts'];
            $comments = $this->get_comments();
            $retData['comments'] = $comments['comments'];
        }else
        {
            $retData['error'] = $posts['message'];
        }

        return $retData;
    }

    private function upload_post(string $postTitle, string $postText, string $postDate, string $userid)
    {
        $result = array('errorCode' => 0,
            'message' => '',
            'inserted' => false);
        try {
            $sql = "INSERT INTO poszt (cim,szoveg,szerzo,datum) VALUES ('".$postTitle."','".$postText."',".$userid.",'".$postDate."')";
            $sth = $this->_db->prepare($sql);
            $result['inserted'] = $sth->execute();
        }catch (PDOException $e)
        {
            $result['errorCode'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    private function get_posts()
    {
        $result = array('errorCode' => 0,
            'message' => '',
            'posts' => array());
        try {
            $sql = "SELECT * FROM poszt AS p INNER JOIN felhasznalo AS f ON f.id = p.szerzo";
            $sth = $this->_db->prepare($sql);
            $sth->execute();
            $result['posts'] = $sth->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e)
        {
            $result['errorCode'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;

    }

    private function get_comments()
    {
        $result = array('errorCode' => 0,
            'message' => '',
            'comments' => array());
        try {
            $sql = "SELECT * FROM komment AS k INNER JOIN felhasznalo AS f ON k.szerzö =  f.id";
            $sth = $this->_db->prepare($sql);
            $sth->execute();
            $result['comments'] = $sth->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e)
        {
            $result['errorCode'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    private function upload_comment(string $commentText,string $postId,string $date,string $userId)
    {
        $result = array('errorCode' => 0,
            'message' => '',
            'inserted' => false);
        try {
            $sql = "INSERT INTO komment(szöveg,datum,szerzö,szulo) VALUES ('".$commentText."','".$date."','".$userId."','".$postId."')";
            $sth = $this->_db->prepare($sql);
            $result['inserted'] = $sth->execute();
        }catch (PDOException $e)
        {
            $result['errorCode'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }
}