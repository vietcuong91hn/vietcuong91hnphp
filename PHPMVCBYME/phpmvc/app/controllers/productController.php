<?php
class productController {

    public function __construct()
    {
    }

    public function indexAction() {

        $name = "PHP Article";
        return view('index', array('name' => $name));
    }

    public function editAction() {

        $name = "PHP Edit";
        return view('index', array('name' => $name));
    }

    public function addAction() {
        $name = "PHP Add";
        return view('index', array('name' => $name));
    }
}