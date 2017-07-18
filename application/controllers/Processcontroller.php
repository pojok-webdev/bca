<?php
class Processcontroller extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    function index(){
            $data = array(
                "role"=>"1",
                "feedData"=>"processimport"
            );
        $this->load->view("importfile/index",$data);
    }
    function import(){
        session_start();
        $_SESSION["username"] = "puji";
        $params = $this->input->post();
        if(isset($_POST["submit"]))
        {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            $c = 0;
            $objarr = array();
            while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
            {
                $name = $filesop[0];
    			$email = $filesop[1];
                array_push($objarr,array("name"=>$name,"email"=>$email));
                $c = $c + 1;
            }
            $filesop = fgetcsv($handle, 1000, ",");
            $data = array(
                "results" =>$objarr,
                "role"=>"1",
                "feedData"=>"processimport"
            );
            $this->load->view("process/importresult",$data);
        }
    }
}