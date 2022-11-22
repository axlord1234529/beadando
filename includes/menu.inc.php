<?php

Class Menu {
    public static $menu = array(
        'nyitolap'=>array('text'=>'Nyitólap','visible'=>array('when logged out'=>1,'when logged in'=>1)),
        'arfolyamok'=>array('text'=>'Árfolyamok','visible'=>array('when logged out'=>1,'when logged in'=>1)),
        'belepes'=>array('text'=>'Belépés','visible'=>array('when logged out'=>1,'when logged in'=>0)),
        'kilepes'=>array('text'=>'Kilépés','visible'=>array('when logged out'=>0,'when logged in'=>1)),

    );

    public static function getMenu($selectedPage)
    {
        $menu = "<ul>";

        foreach (self::$menu as $pageUrl => $pageInfo)
        {
            if($_SESSION['userid'] == 0 && $pageInfo['visible']['when logged out'] )
            {
                $menu .= "<li><a href='".SITE_ROOT.$pageUrl."' ".($pageUrl==$selectedPage[0] ? "class='selected'":"").">".$pageInfo['text']."</a></li>";
            }elseif ($_SESSION['userid'] != 0 && $pageInfo['visible']['when logged in'] )
            {
                $menu .= "<li><a href='".SITE_ROOT.$pageUrl."' ".($pageUrl==$selectedPage[0] ? "class='selected'":"").">".$pageInfo['text']."</a></li>";
            }
        }

        $menu .="</ul>";

        return $menu;
    }
}