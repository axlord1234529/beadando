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
         border: 1px solid brown;
         margin-top: 40px;
     }
     .comments{
         margin-left: 30px;
     }
 </style>
<?php
date_default_timezone_set("Europe/Budapest");
echo"<form action='".SITE_ROOT."forum' method='post'>
    <label>Cím:</label>
    <input type='text' name='post-title'>
    <input type='hidden' name='post-date' value='".date('Y-m-d H:i:s')."'>
    <br>
    <label>Tartalom:</label>
    <textarea name='post-text'></textarea>
    <br>
    <button type='submit' name='submit'>Küld</button>
</form>";

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
                    <textarea name='comment-text'></textarea>
                    <br>
                    <button type='submit' name='submit'>Komment</button>               
                </form> 
                ".$commentsForPost."</div>";

    }
}