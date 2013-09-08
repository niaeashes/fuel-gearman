<?php

namespace Gearman;

class Client
{
	protected static $gearman_client = null;

	public static function _init()
	{
		\Config::load('gearman', true);

		static::$gearman_client = new \GearmanClient();
		static::$gearman_client->addServer(\Config::get('gearman.host', '127.0.0.1'), \Config::get('gearman.port', '4730'));
	}

	public static function forge($name, $workload)
	{
		$name = (string) $name;
		$workload = (string) $workload;

		static::$gearman_client->doBackground($name, $workload);
	}
}