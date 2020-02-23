# cloudclareAPI
php for cloudflare api

# 代码示例
```
<?php
include "cloudflareAPI.php";

$cf=new CFAPI;
$cf->apikey="xtMgnqYnvEtBAfVhunfEMjad7cRKAGRu";
$cf->email="test@test.com";
$cf->zoneid="ehv34HCJoZKw9RJoTjqhupBqLKw3p7tV";
//updateDNS : if domain do not exist,it will auto create a new record.
$cf->updateDNS("www.91yun.org","1.1.1.1");		


?>
```

# DDNS

1. 把server.php放到任何你可以访问到的web服务器上
2. 修改下client.sh里面URL,以确保可以访问到server.php.然后在客户端运行client.sh
```
bash client.sh
```

server.php会自动取得访问的ip并更新到cf上.