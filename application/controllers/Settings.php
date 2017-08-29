<?php
class Settings extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Setting");
        $this->load->model("User");
    }
    function index(){
        session_start();
        $data = array(
            "breadcrumb" => array(1=>"App",2=>"Setting"),
            "formtitle"=>"Setting",
            "feedData"=>"settings",
            "data"=>$this->Setting->getdata(),
            "role"=>$this->User->getrole()
        );
        $this->load->view("commons/settings",$data);
    }
    function save(){
        session_start();
        $params = $this->input->post();
        if(isset($params["btncancel"])){
            redirect("/records");
        }
        $this->Setting->update($params);
        redirect("../index");
    }
}