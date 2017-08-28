<?php
class Record extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getrecord($id){
        $sql = "select id,kodeperusahaan,matauang,totaldata,totalnominal,tanggalefektifad,filler from records ";
        $sql.= "where id=".$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result()[0];
    }
    function getrecords(){
        $sql = "select id,kodeperusahaan,matauang,totaldata,totalnominal,tanggalefektifad,filler from records ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getrecordarray(){
        $sql = "select id,kodeperusahaan,matauang,totaldata,totalnominal,tanggalefektifad,filler from records ";
        $sql.= "order by name";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $arr = array();
        foreach($que->result() as $res){
            $arr[$res->id] = $res->name;
        }
        return $arr;
    }
    function remove($id){
        $sql = "delete from records where id=".$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function save($params){
        $sql = "insert into records (kodeperusahaan,matauang,tanggalefektifad,filler) ";
        $sql.= "values ";
        $sql.= "('".$params['kodeperusahaan']."',";
        $sql.= "'".$params['matauang']."',";
        $sql.= "'".$params['tanggalefektifad']."',";
        $sql.= "'".$params['filler']."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function update($params){
        $sql = "update records set ";
        $sql.= "kodeperusahaan= '".$params["kodeperusahaan"]."',";
        $sql.= "matauang='".$params["matauang"]."',";
        $sql.= "totaldata='".$params["totaldata"]."',";
        $sql.= "totalnominal= '".$params["totalnominal"]."',";
        $sql.= "tanggalefektifad='".$params["tanggalefektifad"]."',";
        $sql.= "filler='".$params["filler"]."' ";
        $sql.= "where ";
        $sql.= "id='".$params['id']."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function getdetail($id){
        $sql = "select id,tipedetail,akun,matauang,jumlah,nama,nomorpelanggan,berita,filler ";
        $sql.= "from recorddetails where record_id='".$id."'";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
}