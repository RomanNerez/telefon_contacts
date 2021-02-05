<?php

class View
{
    public function render ($content_view, $template_view, $data = null)
    {
        if(is_array($data)) {
            extract($data);
        }
        $content_view = ROOT_APP. 'views'.DS.'layout'.DS.$content_view.'.php';
        if(is_file($content_view)){
            ob_start();
            require_once $content_view;
            $body = ob_get_clean();
        }else{
            throw new \Exception("Такой файл ['{$content_view}'] не найден!", 500);
        }

        include ROOT_APP.'views'.DS.$template_view.'.php';
    }

    public function include($template_view)
    {
        include ROOT_APP.'views'.DS.'layout'.DS.$template_view.'.php';
    }

}