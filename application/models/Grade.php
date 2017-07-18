<?php
class Grade extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getgrade($id){
        $sql = "select id,name,sppgroup_id,bimbelgroup_id,dupsbgroup_id,description from grades ";
        $sql.= "where id=".$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result()[0];
    }
    function getgrades(){
        $sql = "select a.id,a.name,a.description,b.amount spp,c.amount bimbel from grades a ";
        $sql.= "left outer join sppgroups b on b.id=a.sppgroup_id ";
        $sql.= "left outer join bimbelgroups c on c.id=a.bimbelgroup_id ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $que->result();
    }
    function getclassarray(){
        $sql = "select id,name,description from grades ";
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
        $sql = "delete from grades where id=".$id;
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function save($params){
        $sql = "insert into grades (name,sppgroup_id,bimbelgroup_id,description) ";
        $sql.= "values ";
        $sql.= "('".$params['name']."','".$params['sppgroup_id']."','".$params['bimbelgroup_id']."','".$params['description']."') ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function update($params){
        $sql = "update grades set name= '".$params["name"]."',sppgroup_id='".$params["sppgroup_id"]."',bimbelgroup_id='".$params["bimbelgroup_id"]."',dupsbgroup_id='".$params["dupsbgroup_id"]."', description='".$params["description"]."' ";
        $sql.= "where ";
        $sql.= "id='".$params['id']."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;
    }
    function updatesppall($params){
        $sql = "update students set sppgroup_id= '".$params["sppgroup_id"]."', ";
        $sql.= "bimbelgroup_id= '".$params["bimbelgroup_id"]."',dupsbgroup_id='".$params["dupsbgroup_id"]."'";
        $sql.= "where ";
        $sql.= "grade_id='".$params['id']."' ";
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $sql;        
    }
}