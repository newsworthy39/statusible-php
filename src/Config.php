<?php

declare(strict_types=1);

namespace newsworthy39;

class Config
{

	private static $container;
	function redis(): array
	{
		// Parameters passed using a named array:
		$config = array(
			'scheme' => 'tcp',
			'host'   => 'redis',
			'port'   => 6379,
			'persistent' => false,
		);
		return $config;
	}

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

	public static function container()
	{
		if (is_null(self::$container)) {
			self::$container = (new \League\Container\Container)->defaultToShared();


			// Add elements to container
			self::$container->add(\League\Plates\Engine::class)->addArgument('templates/');
			self::$container->add(\League\Route\Router::class);
			self::$container->add(Config::class);

			// delegate, some container-control

			// self::$container->add(pdo...)
			// self::$container->add(MySQLDatabaseStrategy)->withArgument($container->get('pdo'));
			//self::$container->add(ORMlayer)->withArgument(MySQLDatabaseStrategy)->withArgument($container->get('pdo'));
			// now get ORMlayer.
		}

		return self::$container;
	}
}
