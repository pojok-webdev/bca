<?php
class About extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        $data = array(
            "breadcrumb" => array(1=>"App",2=>"Tentang"),
            "formtitle"=>"Tentang App",
            "feedData"=>"about"
        );
        $this->load->view("about",$data);
    }
}