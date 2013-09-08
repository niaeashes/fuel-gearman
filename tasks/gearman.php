<?php

namespace Fuel\Tasks;

class Gearman
{
	public function env()
	{
		$bar = str_repeat('-', 48);
		\Cli::write("{$bar}\nCheck environment for fuel-gearman\n{$bar}\n", 'green');

		$gearman_loaded = extension_loaded('gearman');
		$this->yn('Loaded gearman php extension', $gearman_loaded);
	}

	protected function yn($msg, $switch)
	{
		\Cli::write($msg . '... ' . ($switch ? 'yes' : 'no'), ($switch ? 'green' : 'red'));
	}
}