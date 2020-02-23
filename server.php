<?php
include "cloudflareAPI.php";

function getIP()
{
    static $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}

$domain=isset($_GET["domain"])?$_GET["domain"]:"";
$password=isset($_GET["password"])?$_GET["password"]:"";

if($password=="hMEHemTjMR23bFRbKdeEdLYmpynx2AZm"){
    $IP=getIP();
    $cf=new CFAPI;
    $cf->apikey="RF4ZDC6xxVGUHv9bVUCnvFVhZhWUrEv3;
    $cf->email="www@sina.com";
    $cf->zoneid="aZc36CzXikxGfWuFMeQDJKnsRMGENfMd";
    $cf->updateDNS($domain,$IP);		
    echo $IP;
}

?>
