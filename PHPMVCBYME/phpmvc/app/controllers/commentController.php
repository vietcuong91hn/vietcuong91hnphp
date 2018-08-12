<?php
class commentController
{
    public function __construct()
    {
    }

    public function indexAction()
    {
        $name = "PHP Article";
        return view('index', array('name' => $name));
    }

    


}