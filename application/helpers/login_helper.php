<?php
    function checklogin(){
        if(!isset($_SESSION["username"])){
            redirect(base_url()."main/login");
        }
    }
