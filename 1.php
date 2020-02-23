<?php
include "cloudflareAPI.php";

$cf=new CFAPI;
$cf->apikey="xtMgnqYnvEtBAfVhunfEMjad7cRKAGRu";
$cf->email="test@test.com";
$cf->zoneid="ehv34HCJoZKw9RJoTjqhupBqLKw3p7tV";
$cf->updateDNS("www.91yun.org","1.1.1.1");		


?>