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

### Example

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