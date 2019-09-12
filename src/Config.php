<?php

declare(strict_types=1);

namespace newsworthy39;

class Config
{
	
	function githubaccesstoken()
	{
		return "eae69c067063f5eb3de450739a38eca6ee6cc74c";
	}

	function secrets($queue_id)
	{

		$secrets = array(
			86234877 => 'secret',
			86234876 => 'secret2'
		);

		return $secrets[$queue_id];
	}

	function variables($key)
	{
		$config = array(
			'site_title' => 'statusible.com'
		);

		return $config[$key];
	}	
}
