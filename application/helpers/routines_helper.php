<?php
function addspaces($str,$prevlen=0,$postlen=40){
    for($c=0;$c<$prevlen;$c++){
        $str = " ".$str;
    }
    for($c = strlen($str);$c<$postlen;$c++){
        $str.=" ";
    }
    return $str;
}
function add_trailing_zeros($num,$len){
    for($c = strlen($num);$c<$len;$c++){
        $num = "0".$num;
    }
    return $num;
}
function add_end_zeros($num,$len){
    for($c = strlen($num);$c<$len;$c++){
        $num = $num."0";
    }
    return $num;
}
function extractnum($num,$separator = ","){
    $decfound = strpos($num,$separator);
    if($decfound){
        $intg = substr($num,0,$decfound);
        $frac = substr($num,$decfound+1,strlen($num));
    }else{
        $intg = $num;
        $frac = "00";
    }
    return array("intpart"=>$intg,"fracpart"=>$frac);
}
