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
}

