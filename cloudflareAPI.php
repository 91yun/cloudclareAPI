<?php

class CFAPI {

    public $apikey;
    public $email;
	public $zoneid;

	private function curl($url,$method="GET",$data=null)
	{
	
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);                                                                     
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'X-Auth-Email: '.$this->email.'',
		'X-Auth-Key: '.$this->apikey.'',
		'Cache-Control: no-cache',
		'Content-Type:application/json'    		
		));
			
		if (!empty($data)) {
			$data_string = json_encode($data);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);	
		}
		$sonuc = curl_exec($ch);	
		curl_close($ch);
		return $sonuc;
	}

	private function getDomainID($domain)
	{
		$result=$this->curl("https://api.cloudflare.com/client/v4/zones/".$this->zoneid."/dns_records?name=".$domain);
		$json=json_decode($result);
		// var_dump($json->success);
		if (!empty($json->result) and $json->success) {
			return $json->result[0]->id;
		}
		else
		{
			return "";
		}

	}

	public function getuser()
	{
		return $this->curl("https://api.cloudflare.com/client/v4/user");
		
	}

	public function updateDNS($domain,$ip,$type="A",$ttl=120)
	{
		$domainid=$this->getDomainID($domain);
		$data = array(
			'type' => ''.$type.'',
			'name' => ''.$domain.'',
			'content' => ''.$ip.'',
			'proxied' => false,
			'ttl' => $ttl
		);
		if (empty($domainid)) {
			return $this->curl("https://api.cloudflare.com/client/v4/zones/".$this->zoneid."/dns_records","POST",$data);
		}
		else
		{
			return $this->curl("https://api.cloudflare.com/client/v4/zones/".$this->zoneid."/dns_records/".$domainid,"PUT",$data);
		}
		
	}

}

?>