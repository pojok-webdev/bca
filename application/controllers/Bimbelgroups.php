<?php
class Bimbelgroups extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Bimbelgroup");
        $this->load->model("User");
    }
    function index(){
        session_start();
        $data = array(
            "breadcrumb" => array(1=>"Grup Biaya Bimbel",2=>"Daftar"),
            "formtitle"=>"Daftar Grup Biaya Bimbel",
            "feedData"=>"bimbelgroup",
            "objs" => $this->Bimbelgroup->getbimbelgroups(),
            "role"=>$this->User->getrole()
        );
        $this->load->view("bimbelgroups/bimbelgroup",$data);
    }
    function add(){
        session_start();
        $data = array(
            "breadcrumb" => array(1=>"Grup Biaya Bimbel",2=>"Penambahan"),
            "formtitle"=>"Penambahan Grup Bimbel",
            "feedData"=>"bimbelgroup",
            "bimbelgroups"=>$this->Bimbelgroup->getbimbelgroups(),
            "role"=>$this->User->getrole()
        );
        $this->load->view("bimbelgroups/add",$data);        
    }
    function edit(){
        session_start();
        $data = array(
            "breadcrumb" => array(1=>"Grup SPP",2=>"Edit"),
            "formtitle"=>"Edit Grup Bimbel",
            "feedData"=>"bimbelgroup",
            "obj"=>$this->Bimbelgroup->getbimbelgroup($this->uri->segment(3)),
            "role"=>$this->User->getrole()
        );
        $this->load->view("bimbelgroups/edit",$data);        
    }
    function remove(){
        session_start();
        $id = $this->uri->segment(3);
        $this->Bimbelgroup->remove($id);
        redirect("../../");
    }
    function save(){
        session_start();
        $params = $this->input->post();
        $this->Bimbelgroup->save($params);
        redirect("../index");
    }
    function update(){
        session_start();
        $params = $this->input->post();
        echo $this->Bimbelgroup->update($params);
        redirect("../index");
    }
}