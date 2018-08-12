<?php
class indexController {

    public function __construct()
    {
    }

    public function indexAction() {

        //$userModel = new UserModel();
        //$userModel::getUsers();
        //$userModel::getSingleUser();
        $name = "PHP MVC";
        return view('index', array('name' => $name));
    }
}