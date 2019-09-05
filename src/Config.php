<?php 
declare(strict_types=1);

namespace boxeye;

class Config {

	function redis() : array {
		// Parameters passed using a named array:
	 	$config = array(
		       'scheme' => 'tcp',
		       'host'   => 'redis',
			   'port'   => 6379,
			   'persistent' => false,		       
		   );
		return $config;
	}

	function githubaccesstoken() {
		return "eae69c067063f5eb3de450739a38eca6ee6cc74c";
	}

	function secrets($queue_id) {
		
		$secrets = array(
			86234877 => 'secret',
			86234876 => 'secret2'
		);
		
		return $secrets[$queue_id];
	}
}

