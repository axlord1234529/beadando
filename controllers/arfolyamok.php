<?php

class Arfolyamok_Controller
{
    public string $baseName = 'arfolyamok';
    public function main(array $vars)
    {
        $arfolyamokModel = new Arfolyamok_Model();
        $retData = $arfolyamokModel->get_data($vars);
        $view = new View_Loader($this->baseName.'_main');

        foreach($retData as $name => $value)
        {
            $view->assign($name, $value);
        }

    }
}