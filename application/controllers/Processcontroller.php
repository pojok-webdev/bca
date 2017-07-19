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
    function importexisting(){
        session_start();
        $_SESSION["username"] = "puji";
        $record_id = $this->uri->segment(3);
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
    			$nomorrekening = $filesop[1];
                $matauang = $filesop[2];
    			$nominal = $filesop[3];
    			$nama = $filesop[4];
    			$nomorkontrak = $filesop[5];
    			$berita = $filesop[6];
    			$filler = $filesop[7];
                array_push($objarr,array(
                    "id"=>$id,"nomorrekening"=>$nomorrekening,
                    "matauang"=>$matauang,"nominal"=>$nominal,
                    "nama"=>$nama,"nomorkontrak"=>$nomorkontrak,
                    "berita"=>$berita,"filler"=>$filler,
                )
                );
                $c = $c + 1;
            }
            $filesop = fgetcsv($handle, 1000, ",");
            $data = array(
                "results" =>$objarr,
                "role"=>"1",
                "feedData"=>"processimport",
                "record_id"=>$record_id,
            );
            $this->load->view("process/importexisting",$data);
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
    function updatedetails(){
        $params = $this->input->post();
        $ci = & get_instance();
        foreach($params["record"] as $record){
            $sql = "insert into (record_id,tipedetail,akun,matauang,jumlah,nama,nomorpelanggan,berita,filler) ";
            $sql.= "values ";
            $sql.= "('".$params["record_id"]."',";
            $sql.= "'".$record["tipedetail"]."',";
            $sql.= "'".$record["akun"]."',";
            $sql.= "'".$record["matauang"]."',";
            $sql.= "".$record["jumlah"].",";
            $sql.= "'".$record["nama"]."',";
            $sql.= "'".$record["nomorpelanggan"]."',";
            $sql.= "'".$record["berita"]."',";
            $sql.= "'".$record["filler"]."')";
            $ci->db->query($sql);
        }
        echo $ci->db->insert_id();
    }
}