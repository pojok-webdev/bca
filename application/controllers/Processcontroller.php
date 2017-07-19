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
                $id = $filesop[0];
    			$idr = $filesop[1];
                $name = $filesop[2];
    			$kd1 = $filesop[3];
    			$kd2 = $filesop[4];
    			$kd3 = $filesop[5];
    			$month = $filesop[6];
    			$year = $filesop[7];
                array_push($objarr,array(
                    "id"=>$id,"idr"=>$idr,
                    "name"=>$name,"kd1"=>$kd1,
                    "kd2"=>$kd2,"kd3"=>$kd3,
                    "month"=>$month,"year"=>$year,
                )
                );
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
    function print_out(){
        $params = $this->input->post();
        $text = "";
        foreach($params["text"] as $key=>$val){
            $text.=$val[0]." ".$val[1];
            $text.=$val[2]." ".$val[3];
            $text.=$val[4]." ".$val[5];
            $text.=$val[6]." ".$val[7];
            $text.=$val[8] . PHP_EOL;
        }
        $fp = fopen("output/output.txt","w");
        fwrite($fp,$text);
        fclose($fp);
    }
    function printout(){
        $fp = fopen("output/output.txt","w");
        fwrite($fp,"Jajajajaj");
        fclose($fp);
    }
    function printoutfpc(){
        $file = "output/output.txt";
        file_put_contents($file,"Hello");
    }
}