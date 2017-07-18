<?php
class Student extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getStudent($id){
        $sql = "select a.id,a.name,a.nis,a.grade_id,a.sppgroup_id,a.dupsbgroup_id,a.description from students a ";
        $sql.= "right outer join settings b on b.currentyear=a.year ";
        $sql.= "where a.id=".$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result()[0];
    }
    function getStudents(){
        $sql = "select a.id,a.name,a.nis,a.description,b.name grade,c.name sppgroup,c.amount sppamount,d.name dupsb from students a " ;
        $sql.= "left outer join grades b on b.id=a.grade_id ";
        $sql.= "left outer join sppgroups c on c.id=a.sppgroup_id ";
        $sql.= "left outer join dupsbgroups d on d.id=a.dupsbgroup_id ";
        $sql.= "right outer join settings e on e.currentyear=a.year ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function remove($id){
        $sql = "delete from students where id=".$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function save($params){
        $sql = "insert into students (name,nis,grade_id,sppgroup_id,description) ";
        $sql.= "values ";
        $sql.= "('".$params['name']."',";
        $sql.= "'".$params['nis']."',";
        $sql.= "'".$params['grade_id']."',";
        $sql.= "'".$params['sppgroup_id']."',";
        $sql.= "'".$params['description']."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function update($params){
        $sql = "update students set name= '".$params["name"]."',description='".$params["description"]."', ";
        $sql.= "sppgroup_id=".$params["sppgroup_id"].",dupsbgroup_id=".$params["dupsbgroup_id"].",grade_id=".$params["grade_id"].",nis='".$params["nis"]."' ";
        $sql.= "where ";
        $sql.= "id='".$params['id']."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function getspp($nis){
        $sql = "select a.nis,amount from students a left outer join sppgroups b on b.id=a.sppgroup_id where a.nis='".$nis."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0]->amount;
    }    
    function getbimbel($nis){
        $sql = "select a.nis,amount from students a left outer join bimbelgroups b on b.id=a.bimbelgroup_id where a.nis='".$nis."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $res = $que->result();
        return $res[0]->amount;
    }    
}