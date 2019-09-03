<?php

class Config {

	function redis() : array {
		// Parameters passed using a named array:
	 	return array(
		       'scheme' => 'tcp',
		       'host'   => 'redis',
		       'port'   => 6379,
		       'password'   => 'redis',
	       );
	}

	function githubaccesstoken() {
		return "eae69c067063f5eb3de450739a38eca6ee6cc74c";
	}
}

