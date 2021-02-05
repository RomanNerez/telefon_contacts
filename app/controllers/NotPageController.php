<?php

class NotPageController extends Controller
{
    public function index()
    {
        $this->view->render('404','index');
    }
}