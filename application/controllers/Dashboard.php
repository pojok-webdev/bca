<?php
class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
        $data = array(
            "breadcrumb" => array(1=>"App",2=>"Dashboard"),
            "formtitle"=>"Dashboard",
            "feedData"=>"dashboard"
        );
        $this->load->view("dashboard",$data);
    }
}
