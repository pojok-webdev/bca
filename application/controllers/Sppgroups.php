<?php
class Sppgroups extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Sppgroup");
        $this->load->model("User");
    }
    function index(){
        session_start();
        $data = array(
            "breadcrumb" => array(1=>"Grup SPP",2=>"Daftar"),
            "formtitle"=>"Daftar Grup SPP",
            "feedData"=>"sppgroup",
            "objs" => $this->Sppgroup->getsppgroups(),
            "role"=>$this->User->getrole()
        );
        $this->load->view("sppgroups/sppgroup",$data);
    }
    function add(){
        session_start();
        $data = array(
            "breadcrumb" => array(1=>"Grup SPP",2=>"Penambahan"),
            "formtitle"=>"Penambahan Grup SPP",
            "feedData"=>"sppgroup",
            "sppgroups"=>$this->Sppgroup->getsppgroups(),
            "role"=>$this->User->getrole()
        );
        $this->load->view("sppgroups/add",$data);        
    }
    function edit(){
        session_start();
        $data = array(
            "breadcrumb" => array(1=>"Grup SPP",2=>"Edit"),
            "formtitle"=>"Edit Grup SPP",
            "feedData"=>"sppgroup",
            "obj"=>$this->Sppgroup->getsppgroup($this->uri->segment(3)),
            "role"=>$this->User->getrole()
        );
        $this->load->view("sppgroups/edit",$data);        
    }
    function remove(){
        session_start();
        $id = $this->uri->segment(3);
        $this->Sppgroup->remove($id);
        redirect("../../");
    }
    function save(){
        session_start();
        $params = $this->input->post();
        $this->Sppgroup->save($params);
        redirect("../index");
    }
    function update(){
        session_start();
        $params = $this->input->post();
        echo $this->Sppgroup->update($params);
        redirect("../index");
    }
}