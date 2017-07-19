<?php
class Records extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Record");
        $this->load->model("User");
        $this->load->model("Setting");
        $this->load->helper("login");
    }
    function add(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Records",2=>"Penambahan"),
            "formtitle"=>"Penambahan Record",
            "feedData"=>"records",
            "matauang"=>$this->Setting->getdata()->matauang,
            "kodeperusahaan"=>$this->Setting->getdata()->kodeperusahaan,
            "records"=>$this->Record->getrecords(),
            "role"=>$this->User->getrole()
        );
        $this->load->view("records/add",$data);        
    }
    function detail(){
        session_start();
        checklogin();
        $id = $this->uri->segment(3);
        $data = array(
            "breadcrumb" => array(1=>"Records",2=>"Detail"),
            "formtitle"=>"Detail Record",
            "feedData"=>"records",
            "objs"=>$this->Record->getdetail($id),
            "matauang"=>$this->Setting->getdata()->matauang,
            "kodeperusahaan"=>$this->Setting->getdata()->kodeperusahaan,
            "records"=>$this->Record->getrecords(),
            "record_id" => $id,
            "role"=>$this->User->getrole()
        );
        $this->load->view("records/detail",$data);
    }
    function edit(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Records",2=>"Edit"),
            "formtitle"=>"Edit Record",
            "feedData"=>"records",
            "obj"=>$this->Record->getbimbelrecord($this->uri->segment(3)),
            "role"=>$this->User->getrole()
        );
        $this->load->view("records/edit",$data);        
    }
    function index(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Records",2=>"Daftar"),
            "formtitle"=>"Records",
            "feedData"=>"records",
            "objs" => $this->Record->getrecords(),
            "role"=>$this->User->getrole()
        );
        $this->load->view("records/records",$data);
    }
    function remove(){
        session_start();
        checklogin();
        $id = $this->uri->segment(3);
        $this->Bimbelgroup->remove($id);
        redirect("../../");
    }
    function save(){
        session_start();
        checklogin();
        $params = $this->input->post();
        $this->Record->save($params);
        redirect("../index");
    }
    function update(){
        session_start();
        checklogin();
        $params = $this->input->post();
        echo $this->Record->update($params);
        redirect("../index");
    }
}