<?php
class Tester extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper("routines");
    }
    function addspaces(){
        $this->load->helper("routines");
        echo addspaces("bebek",20) . "h";
    }
    function testsubstr(){
        $str = "125,54,34";
        $decfound = strpos($str,",");
        if($decfound){
            $intg = substr($str,0,$decfound);
            $frac = substr($str,$decfound,strlen($str));
        }else{
            $intg = $str;
            $frac = "00";
        }
        echo $intg . " and " . $frac . "<br />";
    }
    function getterbilang(){
        $str = $this->uri->segment(3);
        $this->load->helper("currency");
        terbilang($str);
    }
    function get_terbilang(){
        $this->load->helper("terbilang");
        $str = $this->uri->segment(3);
        echo terbilang($str);
    }
    function getmonths(){
        $this->load->helper("datetime");
        echo "TEST Get Months <br />";
        $arr = getmontharray(1,2016,3,2017);
        foreach($arr as $key=>$val){
            echo $key . " and " . $val . "<br />";
        }
    }
    function addzero(){
        $str = $this->uri->segment(3);
        $this->load->helper("datetime");
        echo "TEST Add Zero <br />";
        echo addzero($str);
    }
    function phpinfo(){
        phpinfo();
    }
    function removezero(){
        $this->load->helper("datetime");
        $number = $this->uri->segment(3);
        echo removezero($number);
    }
    function changepassword(){
        $COMMENT = "INTERFACE FOR CHANGE PASSWORD ";
        $COMMENT.= "http://albadar/tester/changepassword/2/puji";
        $id= $this->uri->segment(3);
        $pass = $this->uri->segment(4);
        if ($this->User->changepassword($id,$pass)){
            echo "sukses";
        }else{
            echo "tidak sukses";
        };
    }
    function testheader(){
        $record_id = $this->uri->segment(3);
        $sql = "select a.id,a.hdr_rec_type,a.hdr_data,a.kodeperusahaan,a.matauang,a.tanggalefektifad,";
        $sql.= "count(b.id) totaldata,sum(b.jumlah) totalnominal from records a ";
        $sql.= "left outer join recorddetails b on b.record_id = a.id ";
        $sql.= "where a.id=".$record_id. " ";
        $sql.= "group by a.id,a.hdr_rec_type,a.hdr_data,a.kodeperusahaan,a.matauang,a.tanggalefektifad";
        $que = $this->db->query($sql);
        $res = $que->result()[0];
        $nominal = extractnum($res->totalnominal,".");
        $out = $res->hdr_rec_type;
        $out.= $res->hdr_data;
        $out.= addspaces($res->kodeperusahaan,0,8);
        $out.= $res->matauang;
        $out.= add_trailing_zeros($res->totaldata,7);
        $out.= add_trailing_zeros($nominal["intpart"].$nominal["fracpart"],17);
        $out.= $res->tanggalefektifad;
        echo $out;
    }
}