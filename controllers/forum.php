<?php


class Forum_Controller
{
    public string $baseName = 'forum';

    public function main(array $vars)
    {
        $forumModel = new Forum_model();
        $retData = $forumModel->get_data($vars);
        $view = new View_Loader($this->baseName . '_main');

        foreach ($retData as $name => $value) {
            $view->assign($name, $value);
        }

    }
}