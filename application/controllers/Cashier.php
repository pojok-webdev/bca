<?php
class Cashier extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("Mcashier");
        $this->load->model("Student");
        $this->load->helper("terbilang");
        $this->load->library("Dates");
        $this->load->helper("datetime");
    }
    function index(){
        session_start();
        checklogin();
        $this->load->helper("form");
        $data = array(
            "breadcrumb" => array(1=>"Pembayaran",2=>"SPP"),
            "formtitle"=>"Pembayaran SPP",
            "feedData"=>"cashier",
            "months"=>$this->dates->getmonthsarray(),
            "years"=>$this->dates->getyearsarray(),
            "curmonth"=>date('m'),
            "curyear"=>date("Y"),
            "err_message"=>"",
            "role"=>$this->User->getrole(),
        );
        $this->load->view("cashiers/spp",$data);
    }
    function checksession(){
        if (session_status() == PHP_SESSION_NONE) {
            if(!isset($_SESSION["username"])){
                redirect("../../main/login");
            }
            echo $_SESSION["username"];
        }
    }
    function savesession(){
        session_start();
        checklogin();
        $CHECKSESSION = false;
        if($CHECKSESSION){
            $this->checksession();
        }
        $params = $this->input->post();
        if(!isset($params["sppfrstyear"])){
            redirect("../");
        }
        $currentyear = $this->dates->getcurrentyear();
        $DEBUG = false;
        if($DEBUG){
            foreach($params as $key=>$val){
                echo $key . ' : ' . $val;
            }
        }
        $montharray = array();
        $sppmonthcount = 1;
        if($params["sppfrstyear"]===$params["sppnextyear"]){
            $sppmonthcount += $params["sppnextmonth"] - $params["sppfrstmonth"];
        }
        if($params["sppnextyear"]<$params["sppfrstyear"]){
            $firstyearmonthcount = 12-$params["sppfrstmonth"];
            $yearcount = $params["sppnextyear"] - $params["sppfrstyear"];
            $lastyearmonthcount = $params["sppnextmonth"]; 
            $sppmonthcount += $firstyearmonthcount + 12*$yearcount + $lastyearmonthcount;
        }
        $bimbelmonthcount = 1;
        if($params["bimbelfrstyear"]===$params["bimbelnextyear"]){
            $bimbelmonthcount += $params["bimbelnextmonth"] - $params["bimbelfrstmonth"];
        }
        if($params["bimbelnextyear"]<$params["bimbelfrstyear"]){
            $firstyearmonthcount = 12-$params["bimbelfrstmonth"];
            $yearcount = $params["bimbelnextyear"] - $params["bimbelfrstyear"];
            $lastyearmonthcount = $params["bimbelnextmonth"]; 
            $bimbelmonthcount += $firstyearmonthcount + 12*$yearcount + $lastyearmonthcount;
        }
        $_SESSION["sppfrstmonth"] = $params["sppfrstmonth"];
        $_SESSION["sppfrstyear"] = $params["sppfrstyear"];
        $_SESSION["sppnextmonth"] = $params["sppnextmonth"];
        $_SESSION["sppnextyear"] = $params["sppnextyear"];
        $_SESSION["nis"] = $params["nis"];
        $_SESSION["studentname"] = $params["studentname"];
        $_SESSION["spp"] = removedot($params["spp"]);
        $_SESSION["bimbelfrstyear"] = $params["bimbelfrstyear"];
        $_SESSION["bimbelfrstmonth"] = $params["bimbelfrstmonth"];
        $_SESSION["bimbelnextmonth"] = $params["bimbelnextmonth"];
        $_SESSION["bimbelnextyear"] = $params["bimbelnextyear"];
        $_SESSION["psb"] = removedot($params["psb"]);
        $_SESSION["book"] = removedot($params["book"]);
        $_SESSION["grade"] = $params["grade"];
        $_SESSION["cashpay"] = removedot($params["cashpay"]);
        $_SESSION["bimbel"] = removedot($params["bimbel"]);
        $_SESSION["dupsbpaid"] = $this->Mcashier->getdupsbpaid($params["nis"],$currentyear);
        $_SESSION["bookpaymentpaid"] = $this->Mcashier->getbookpaymentpaid($params["nis"],$currentyear);
        $_SESSION["allpaid"] = $this->Mcashier->getallpaid($params["nis"],$currentyear);
        
        $_SESSION["total"] = $_SESSION["psb"]+$_SESSION["spp"]+$_SESSION["book"]+$_SESSION["bimbel"];
        $_SESSION["sppmonthcount"] = $sppmonthcount;
        $_SESSION["bimbelmonthcount"] = $bimbelmonthcount;
        $_SESSION["orispp"] = $params["orispp"];
        $_SESSION["oribimbel"] = $params["oribimbel"];
        $total = 0;
        $total+= $this->Mcashier->getdupsbremain($params["nis"],$currentyear);
        $total+= $this->Student->getspp($params["nis"]);
        $total+= $this->Student->getbimbel($params["nis"]);
        $total+= $this->Mcashier->getbookpaymentremain($params["nis"],$currentyear);
        
        $dupsbremain = $this->Mcashier->getdupsbremain($params["nis"],$currentyear);
        $bookpaymentremain = $this->Mcashier->getbookpaymentremain($params["nis"],$currentyear);
        $sppremain = $this->Mcashier->getsppremain($params["nis"]);
        $bimbelremain = $this->Mcashier->getbimbelremain($params["nis"]);
        $_SESSION["totaltagihan"] = $dupsbremain+$bookpaymentremain+$sppremain["tagihan"]+$bimbelremain["tagihan"];
        
        $remain = 0;
        $remain+= $this->Mcashier->gettotaltagihan($params["nis"],$currentyear);
        $remain+= $this->Student->getspp($params["nis"]);
        $remain+= $this->Student->getbimbel($params["nis"]);
        $remain-=$params["spp"];
        $remain-=$params["bimbel"];
        $remain-=$params["book"];
        $remain-=removedot($params["psb"]);
        $_SESSION["tagihanremain"] = $remain;
        $_SESSION["sppremain"] = $this->Mcashier->getsppremain($params["nis"])["tagihan"];
        $_SESSION["bimbelremain"] = $this->Mcashier->getbimbelremain($params["nis"])["tagihan"];
        $_SESSION["dupsbremain"] = $this->Mcashier->getdupsbremain($params["nis"],$currentyear) - removedot($params["psb"]);
        $_SESSION["bookpaymentremain"] = $this->Mcashier->getbookpaymentremain($params["nis"],$currentyear);
        if(isset($params["sppcheckbox"])){
            $_SESSION["sppcheckbox"] = "1";
        }else{
            $_SESSION["sppcheckbox"] = "0";
        }
        $this->previewkwitansi();
    }
    function previewkwitansi(){
        $check = true;
        $DEBUG = false;
        if((!isset($_SESSION["studentname"])||trim($_SESSION["studentname"]===""))){
            $check = false;
            $err_msg = "Siswa belum dipilih";
        }
        if((trim($_SESSION["cashpay"]===""))||($_SESSION["cashpay"]==="0")){
            $check = false;
            $err_msg = "Jumlah Pembayaran tidak boleh kosong";
        }
        $params = array(
            "sppfrstmonth"=>$_SESSION["sppfrstmonth"],
            "sppfrstyear"=>$_SESSION["sppfrstyear"],
            "sppnextmonth"=>$_SESSION["sppnextmonth"],
            "sppnextyear"=>$_SESSION["sppnextyear"],
            "nis"=>$_SESSION["nis"],
            "studentname"=>$_SESSION["studentname"],
            "spp"=>$_SESSION["spp"],
            "bimbelfrstyear"=>$_SESSION["bimbelfrstyear"],
            "bimbelfrstmonth"=>$_SESSION["bimbelfrstmonth"],
            "bimbelnextmonth"=>$_SESSION["bimbelnextmonth"],
            "bimbelnextyear"=>$_SESSION["bimbelnextyear"],
            "psb"=>$_SESSION["psb"],
            "book"=>$_SESSION["book"],
            "grade"=>$_SESSION["grade"],
            "cashpay"=>$_SESSION["cashpay"],
            "bimbel"=>$_SESSION["bimbel"],
            "dupsbremain"=>$_SESSION["dupsbremain"],
            "dupsbpaid"=>$_SESSION["dupsbpaid"],
            "bookpaymentremain"=>$_SESSION["bookpaymentremain"],
            "bookpaymentpaid"=>$_SESSION["bookpaymentpaid"],
            "allpaid"=>$_SESSION["allpaid"],
            "totaltagihan"=>$_SESSION["totaltagihan"],
            "total"=>$_SESSION["total"],
            "sppmonthcount"=>$_SESSION["sppmonthcount"],
            "bimbelmonthcount"=>$_SESSION["bimbelmonthcount"],
            "monthsarray"=>$this->dates->getmonthsarray(),
            "orispp"=>$_SESSION["orispp"],
            "oribimbel"=>$_SESSION["oribimbel"],
            "sppcheckbox"=>$_SESSION["sppcheckbox"],
            "role"=>$this->User->getrole(),
            "periodmonths"=>getperiodmonths(),
            "tagihanremain"=>$_SESSION["tagihanremain"],
            "sppremain"=>$_SESSION["sppremain"],
            "bimbelremain"=>$_SESSION["bimbelremain"],
        );
        if($DEBUG){
            echo "SPP : ". $_SESSION["spp"] . "<br />";
            echo "psb : ". $_SESSION["psb"] . "<br />";
            echo "book : ". $_SESSION["book"] . "<br />";
            echo "Bimbel : ". $_SESSION["bimbel"] . "<br />";
            echo "total : ". $_SESSION["total"] . "<br />";
            echo "dupsbpaid : ". $_SESSION["dupsbpaid"] . "<br />";
        }
        if((!$check)){
            $this->load->library("Dates");
            $this->load->helper("form");
            $data = array(
                "breadcrumb" => array(1=>"Pembayaran",2=>"SPP"),
                "formtitle"=>"Pembayaran SPP",
                "feedData"=>"cashier",
                "months"=>$this->dates->getmonthsarray(),
                "years"=>$this->dates->getyearsarray(),
                "curmonth"=>date('m'),
                "curyear"=>date("Y"),
                "err_message"=>" (".$err_msg.")",
                "role"=>$this->User->getrole(),
            );
            $this->load->view("cashiers/spp",$data);
        }else{
            $params["topaid"] = $_SESSION["total"];
            $this->load->view("cashiers/previewkwitansi",$params);
        }
    }
    function saveall(){
        $params = $this->input->post();
        $this->savebimbel($params);
        $this->savespp($params);
    }
    function savebimbel($params){
        session_start();
        $montharray = getmontharray($params["bimbelfrstmonth"],$params["bimbelfrstyear"],$params["bimbelnextmonth"],$params["bimbelnextyear"]);
        foreach($montharray as $monthyear){
            $month = substr($monthyear,0,2);
            $year = substr($monthyear,2,4);
            $purpose = "Untuk pembayaran Bimbel bulan " . $month . '/' . $year;
            $description = "Untuk pembayaran Bimbel bulan " . $month . '/' . $year;
            $sql = "insert into bimbel ";
            $sql.= "(nis,amount,pyear,pmonth,cyear,paymenttype,purpose,description,createuser) ";
            $sql.= "values ";
            $sql.= "('";
            $sql.= $params["nis"]."','";
            $sql.= $params["oribimbel"]."','";
            $sql.= $year."','";
            $sql.= $month."','";
            $sql.= $this->dates->getcurrentyear()."','1','";
            $sql.= $purpose."','".$description."','".$_SESSION["username"]."')";
            $ci = & get_instance();
            $que = $ci->db->query($sql);
        }
    }
    function savespp($params){
        //session_start();
        $montharray = getmontharray($params["sppfrstmonth"],$params["sppfrstyear"],$params["sppnextmonth"],$params["sppnextyear"]);
        //if($params["sppcheckbox"]>0){
            foreach($montharray as $monthyear){
                $month = substr($monthyear,0,2);
                $year = substr($monthyear,2,4);
                $purpose = "Untuk pembayaran SPP bulan " . $month . '/' . $year;
                $description = "Untuk pembayaran SPP bulan " . $month . '/' . $year;
                $sql = "insert into spp ";
                $sql.= "(nis,amount,pyear,pmonth,cyear,paymenttype,purpose,description,createuser) ";
                $sql.= "values ";
                $sql.= "('".$params["nis"]."','";
                $sql.= $params["orispp"]."','";
                $sql.= $year."','";
                $sql.= $month."','";
                $sql.= $this->dates->getcurrentyear()."','1','";
                $sql.= $purpose."','";
                $sql.= $description."','";
                $sql.= $_SESSION["username"]."')";
                $ci = & get_instance();
                $que = $ci->db->query($sql);
            }
        //}
        echo $montharray[0];
        $this->savedupsb($params);
        $this->savepembayaranbuku($params);
        $this->kwitansi($params);
    }
    function savedupsb($params){
        if($params["psb"]>0){
            $this->load->library("Dates");
            $currentyear = $this->dates->getcurrentyear();
            $sql = "insert into dupsb ";
            $sql.= "(nis,amount,year,paymenttype,purpose,description,createuser) ";
            $sql.= "values ";
            $sql.= "('".$params["nis"]."','";
            $sql.= $params["psb"]."','";
            $sql.= $currentyear."','1','Pembayaran DU/PSB','Pembayaran DU/PSB','".$_SESSION["username"]."')";
            $ci = & get_instance();
            $que = $ci->db->query($sql);
        }
    }
    function savepembayaranbuku($params){
        if($params["book"]>0){
            $this->load->library("Dates");
            $currentyear = $this->dates->getcurrentyear();
            $sql = "insert into bookpayment ";
            $sql.= "(nis,amount,year,paymenttype,createuser) ";
            $sql.= "values ";
            $sql.= "('".$params["nis"]."','".$params["book"]."','".$currentyear."','1','".$_SESSION["username"]."')";
            $ci = & get_instance();
            $que = $ci->db->query($sql);
        }
    }
    function kwitansi(){
        session_start();
        $params = array(
            "allpaid"=>$_SESSION["allpaid"],
            "sppfrstmonth"=>$_SESSION["sppfrstmonth"],
            "sppfrstyear"=>$_SESSION["sppfrstyear"],
            "sppnextmonth"=>$_SESSION["sppnextmonth"],
            "sppnextyear"=>$_SESSION["sppnextyear"],
            "nis"=>$_SESSION["nis"],
            "studentname"=>$_SESSION["studentname"],
            "spp"=>$_SESSION["spp"],
            "bimbelfrstyear"=>$_SESSION["bimbelfrstyear"],
            "bimbelfrstmonth"=>$_SESSION["bimbelfrstmonth"],
            "bimbelnextmonth"=>$_SESSION["bimbelnextmonth"],
            "bimbelnextyear"=>$_SESSION["bimbelnextyear"],
            "psb"=>$_SESSION["psb"],
            "book"=>$_SESSION["book"],
            "grade"=>$_SESSION["grade"],
            "cashpay"=>$_SESSION["cashpay"],
            "dupsbremain"=>$_SESSION["dupsbremain"],
            "dupsbpaid"=>$_SESSION["dupsbpaid"],
            "bookpaymentremain"=>$_SESSION["bookpaymentremain"],
            "bookpaymentpaid"=>$_SESSION["bookpaymentpaid"],
            "totaltagihan"=>$_SESSION["totaltagihan"],
            "bimbel"=>$_SESSION["bimbel"],
            "total"=>$_SESSION["total"],
            "sppmonthcount"=>$_SESSION["sppmonthcount"],
            "bimbelmonthcount"=>$_SESSION["bimbelmonthcount"],
            "monthsarray"=>$this->dates->getmonthsarray(),
            "role"=>$this->User->getrole(),
            "periodmonths"=>getperiodmonths(),
            "tagihanremain"=>$_SESSION["tagihanremain"],
            "sppremain"=>$_SESSION["sppremain"],
            "bimbelremain"=>$_SESSION["bimbelremain"]
        );
        $params["topaid"] = $_SESSION["total"];
        $this->load->view("cashiers/kwitansi",$params);
    }
}