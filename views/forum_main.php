 <style>
     .title-row{
         display: flex;
         align-items: center;
         margin-bottom: 0px;
     }
     .title{
         margin-right: 30px;

     }
     .posts{
         margin-top: 40px;
     }
     .comments{
         margin-left: 30px;
     }
 </style>
<?php
date_default_timezone_set("Europe/Budapest");
echo"<div class='forum-wrapper'><form action='".SITE_ROOT."forum'  method='post'>
    <input type='text' name='post-title' placeholder='Cím' required>
    <input type='hidden' name='post-date' value='".date('Y-m-d H:i:s')."'>
    <br>
    <textarea name='post-text'  placeholder='Tartalom' required></textarea>
    <br>
    <input type='submit' name='submit' value='Küld'>
</form></div>";

if(isset($viewData['posts']))
{
    foreach ($viewData['posts'] as $post)
    {
        $commentsForPost = "";
        foreach ($viewData['comments'] as $comment)
        {
            if($post['id'] == $comment['szulo'])
            {
                $commentsForPost .= "<div class='comments'><strong>".$comment['login_nev']."</strong> <span>(".$comment['datum'].")</span><p>".$comment['szöveg']."</p></div>";
            }
        }
        echo "<div class='posts'> <div class='title-row' style='display: flex'><h1 class='title'>".$post['cim']."</h1> (".$post['login_nev']." , ".$post['datum'].")</div> <p class='post-text'>".$post['szoveg']."</p>
                <form action='".SITE_ROOT."forum' method='post'>
                    <input type='hidden' name='comment-post' value='".$post['id']."'>
                    <input type='hidden' name='comment-date' value='".date('Y-m-d H:i:s')."'>
                    <textarea name='comment-text' required></textarea>
                    <br>
                    <input type='submit' name='submit' value='Komment'>               
                </form> 
                ".$commentsForPost."</div>";

    }
}