<?php

namespace streamchartz;

require __DIR__ . '/vendor/autoload.php';

class wallApi {
	
	const remoteGetApi = 'https://streamchartz.com/fwall/posts'; 
	
	/*
	 * Load wall from remote server
	 * */
	static function getWall($query) {
		
		$curl = new \Curl\Curl();
		$curl->setUserAgent('streamchartz client v0.1');		
		$curl->setReferer((self::isSecure() ? 'https://' : 'http://' ).$_SERVER['HTTP_HOST']);
		$curl->setTimeout(10); // stop query when takes longer than 5 sec
		
		$curl->get(self::remoteGetApi, $query);
		
		if ($curl->error) {
		    echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage;
		   return false;
		} else {
		    return $curl->response;
		}
		
		$curl->close();
		
	}
	
	static private function isSecure() {
	  return
	    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
	    || $_SERVER['SERVER_PORT'] == 443;
	}	
	
	
}
