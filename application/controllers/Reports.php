<?php
class Reports extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("report");
        $this->load->helper("datetime");
        $this->load->model("setting");
        $this->load->model("grade");
        $this->load->library("dates");
    }
    function filtertransactionperuser(){
        $params = $this->input->post();
        redirect("../transactionperuser/".addzero($params["month"])."/".$params["year"]."/".$params["user"]);
    }
    function index(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Laporan",2=>"Daftar"),
            "formtitle"=>"Laporan-laporan",
            "feedData"=>"reports",
            "err_message"=>"",
            "role"=>$this->User->getrole()
        );
        $this->load->view("reports/index",$data);
    }
    function dailyrekapperuser(){
        session_start();
        checklogin();
        if($this->uri->total_segments()>4){
            $user = $this->uri->segment(5);
            $dailyreports = $this->report->dailyrekapperuser();
        }else{
            $user = "all";
            $dailyreports = $this->report->dailyrekapperuser();
        }
        $data = array(
            "breadcrumb" => array(1=>"Laporan",2=>"Rekap Harian Per Petugas"),
            "formtitle"=>"Rekap Harian Per Petugas",
            "feedData"=>"reports",
            "err_message"=>"",
            "role"=>$this->User->getrole(),
            "dailyreports"=>$this->report->dailyrekapperuser(),
            "users"=>$this->User->getarray(),
            "user"=>$user,
            "humanmonth"=>getperiodmonths()
        );
        $this->load->view("reports/dailyrekapperuser",$data);        
    }
    function dailytransactions(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Laporan",2=>"Rekap Transaksi Harian"),
            "formtitle"=>"Rekap Transaksi Harian",
            "feedData"=>"reports",
            "err_message"=>"",
            "role"=>$this->User->getrole(),
            "dailyreports"=>$this->report->getdailytransaction(),
            "humanmonth"=>getperiodmonths()
        );
        $this->load->view("reports/dailytransactions",$data);
    }
    function transactionperuser(){
        session_start();
        checklogin();
        $month = $this->uri->segment(3);
        $year = $this->uri->segment(4);
        if($this->uri->total_segments()>4){
            $user = $this->uri->segment(5);
            $dailyreports = $this->report->gettransactionperuser($month,$year,$user);
        }else{
            $user = "all";
            $dailyreports = $this->report->gettransactionperuser($month,$year);
        }
        $data = array(
            "breadcrumb" => array(1=>"Laporan",2=>"Rekap Transaksi Harian"),
            "formtitle"=>"Rekap Transaksi Harian",
            "feedData"=>"reports",
            "err_message"=>"",
            "role"=>$this->User->getrole(),
            "dailyreports"=>$dailyreports,
            "humanmonth"=>getperiodmonths(),
            "month"=>$this->uri->segment(3),
            "year"=>$this->uri->segment(4),
            "years"=>$this->dates->getyearsarray(),
            "users"=>$this->User->getarray(),
            "user"=>$user
        );
        $this->load->view("reports/transactionperuser",$data);
    }    
    function sppbimbel(){
        session_start();
        checklogin();
        $pyear = $this->setting->getcurrentyear();
        $spp = $this->report->getspp($pyear);
        $bimbel = $this->report->getbimbel($pyear);
        $data = array(
            "breadcrumb" => array(1=>"Laporan",2=>"Rekap Pembayaran SPP &amp; Bimbel"),
            "formtitle"=>"Rekap Pembayaran SPP &amp; Bimbel",
            "feedData"=>"reports",
            "err_message"=>"",
            "role"=>$this->User->getrole(),
            "pyear"=>$pyear,
            "spp"=>$spp,
            "bimbel"=>$bimbel,
            "spptotal"=>$this->report->getspptotal($pyear)[0]->spp,
            "bimbeltotal"=>$this->report->getbimbeltotal($pyear)[0]->bimbel
        );
        $this->load->view("reports/sppbimbel",$data);
    }
    function dubuku(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Laporan",2=>"Rekap Pembayaran DU &amp; Buku"),
            "formtitle"=>"Rekap Pembayaran DU &amp; Buku",
            "feedData"=>"reports",
            "err_message"=>"",
            "role"=>$this->User->getrole()
        );
        $this->load->view("reports/dubuku",$data);
    }
    function tertanggung(){
        session_start();
        checklogin();
        $data = array(
            "breadcrumb" => array(1=>"Laporan",2=>"Rekap Tertanggung"),
            "formtitle"=>"Rekap Tertanggung",
            "feedData"=>"reports",
            "humanmonth"=>getperiodmonths(),
            "students"=>$this->report->gettertanggung(),
            "err_message"=>"",
            "role"=>$this->User->getrole()
        );
        $this->load->view("reports/tertanggung",$data);
    }
    function rekapsppperkelas(){
        session_start();
        checklogin();
        $pyear = $this->setting->getcurrentyear();
        $spp = $this->report->getspp($pyear);
        $bimbel = $this->report->getbimbel($pyear);
        $data = array(
            "breadcrumb" => array(1=>"Laporan",2=>"Rekap Pembayaran SPP"),
            "formtitle"=>"Rekap Pembayaran SPP",
            "feedData"=>"reports",
            "err_message"=>"",
            "role"=>$this->User->getrole(),
            "pyear"=>$pyear,
            "spp"=>$spp,
            "bimbel"=>$bimbel,
            "spptotal"=>$this->report->getspptotal($pyear)[0]->spp,
            "bimbeltotal"=>$this->report->getbimbeltotal($pyear)[0]->bimbel,"periodmonths"=>getperiodmonths(),
            "objs"=>$this->report->getrekapsppperkelas()
        );
        $this->load->view("reports/rekapsppperkelas",$data);
    }
    function filterrekapbimbelperkelas(){
        session_start();
        checklogin();
        $pyear = $this->setting->getcurrentyear();
        $data = array(
            "breadcrumb" => array(1=>"Laporan",2=>"Rekap Pembayaran Bimbel"),
            "formtitle"=>"Rekap Pembayaran Bimbel",
            "feedData"=>"reports",
            "err_message"=>"",
            "role"=>$this->User->getrole(),
            "pyear"=>$pyear,
            "periodmonths"=>getperiodmonths(),
            "objs"=>$this->report->getrekapbimbelperkelas(),
            "grades"=>$this->grade->getclassarray()
        );
        $this->load->view("reports/filterrekapbimbelperkelas",$data);
    }
    function rekapbimbelperkelas(){
        session_start();
        checklogin();
        $pyear = $this->setting->getcurrentyear();
        $data = array(
            "breadcrumb" => array(1=>"Laporan",2=>"Rekap Pembayaran Bimbel"),
            "formtitle"=>"Rekap Pembayaran Bimbel",
            "feedData"=>"reports",
            "err_message"=>"",
            "role"=>$this->User->getrole(),
            "pyear"=>$pyear,
            "periodmonths"=>getperiodmonths(),
            "objs"=>$this->report->getrekapbimbelperkelas()
        );
        $this->load->view("reports/rekapbimbelperkelas",$data);
    }
    function getsumrekapbimbelperkelas(){
        echo $this->report->getsumrekapbimbelperkelas();
    }
}