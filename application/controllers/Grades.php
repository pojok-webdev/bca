<?php
class Grades extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Grade");
        $this->load->model("Sppgroup");
        $this->load->model("Bimbelgroup");
        $this->load->model("Dupsbgroup");
        $this->load->model("User");
    }
    function index(){
        session_start();
        $data = array(
            "breadcrumb" => array(1=>"Kelas",2=>"Daftar"),
            "formtitle"=>"Daftar Kelas",
            "feedData"=>"kelas",
            "objs" => $this->Grade->getgrades(),
            "role"=>$this->User->getrole()
        );
        $this->load->view("grades/grades",$data);
    }
    function add(){
        session_start();
        $data = array(
            "breadcrumb" => array(1=>"Kelas",2=>"Penambahan"),
            "formtitle"=>"Penambahan Kelas",
            "feedData"=>"kelas",
            "grades"=>$this->Grade->getgrades(),
            "sppdefault"=>$this->Sppgroup->getsppgrouparray(),
            "bimbeldefault"=>$this->Bimbelgroup->getbimbelgrouparray(),
            "role"=>$this->User->getrole()
        );
        $this->load->view("grades/add",$data);        
    }
    function edit(){
        session_start();
        $data = array(
            "breadcrumb" => array(1=>"Kelas",2=>"Edit"),
            "formtitle"=>"Edit Kelas",
            "feedData"=>"kelas",
            "obj"=>$this->Grade->getgrade($this->uri->segment(3)),
            "sppdefault"=>$this->Sppgroup->getsppgrouparray(),
            "bimbeldefault"=>$this->Bimbelgroup->getbimbelgrouparray(),
            "dupsbdefault"=>$this->Dupsbgroup->getDupsbgrouparray(),
            "role"=>$this->User->getrole()
        );
        $this->load->view("grades/edit",$data);        
    }
    function remove(){
        session_start();
        $id = $this->uri->segment(3);
        $this->Grade->remove($id);
        redirect("../../");
    }
    function save(){
        session_start();
        $params = $this->input->post();
        $this->Grade->save($params);
        redirect("../index");
    }
    function update(){
        session_start();
        $params = $this->input->post();
        $this->Grade->update($params);
        $this->Grade->updatesppall($params);
        redirect("../index");
    }
}