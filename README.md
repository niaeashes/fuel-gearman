fuel-gearman
============

Install
------------

	git submodule add git://github.com/niaeashes/fuel-gearman.git fuel/packages/gearman

Check environment
------------

	oil r gearman:env

Wakeup a new worker
------------

	oil refine gearman:worker <class_name>

Do a new job
------------

	oil refine gearman:job <function_name> <workload>

Example
------------

**Worker_Sample on fuel/app/classes/worker/sample.php**

	<?php
	
	class Worker_Sample
	{
		public function work_sample($job)
		{
			Log::info($job->workload());
		}
	}

**Wakeup sample worker**

	oil refine gearman:worker Worker_Sample

**Do sample job**

	oil refine gearman:job sample 'This is sample job'

**result (log file)**

	INFO - 2013-09-08 11:42:27 --> This is sample job