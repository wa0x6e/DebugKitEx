<?php
/**
 * DebugKitEx Resque Panel View
 *
 * Copyright (c) 2012, Wan Chen (Kamisama)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author 		Wan Qi Chen <kami@kamisama.me>
 * @copyright 	Copyright 2012, Wan Qi Chen <kami@kamisama.me>
 * @link 		https://github.com/kamisama/DebugKitEx
 * @package 	DebugKitEx
 * @subpackage 	DebugKitEx.View.Elements
 * @since 		2.2.1
 * @license 	MIT License (http://www.opensource.org/licenses/mit-license.php)
 */


?>
<h2><?php echo __d('debug_kit_ex', 'Resque Jobs Logs')?></h2>
<?php if (!empty($content)) : ?>
	<?php foreach ($content as $queue => $jobs): ?>
	<div class="sql-log-panel-query-log">
		<div class="head-bloc"><h4 title="<?php echo $queue ?> queue"><?php echo $queue ?></h4></div>
		<?php

			if (!empty($jobs))
			{
				echo '<table class="debug-table debug_ex-table">';
				echo '<tr>';
				echo '<th>'.__d('debug_kit_ex', 'Job Id').'</th>';
				echo '<th>'.__d('debug_kit_ex', 'Job Class').'</th>';
				echo '<th>'.__d('debug_kit_ex', 'Method').'</th>';
				echo '<th>'.__d('debug_kit_ex', 'From').'</th>';
				echo '</tr>';

				$totalJobs = 0;
				foreach($jobs as $job)
				{
					echo '<tr>';
					echo '<td>#'.$job['jobId']. '</td>';
					echo '<td>'.$job['class']. '</td>';
					echo '<td>'.$job['method']. '</td>';
					echo '<td>' . sprintf('%s <small class="trace_line">line %s</small>', str_replace(APP, '', $job['caller'][0]['file']), $job['caller'][0]['line']);
					echo '<pre class="code-on-demand"><code>'.var_export($job['args'], true). '</code></pre>';
					echo '</td>';
					echo '</tr>';

					$totalJobs++;

				}

				echo '<tr class="table-summary">';
				echo '<td colspan=4 style="text-align:center">';
				echo __dn('debug_kit_ex', '%d job', '%d jobs', $totalJobs, $totalJobs);
				echo '</td>';
				echo '</tr>';

				echo '</table>';
			}
		 ?>

	</div>
	<?php endforeach; ?>
<?php elseif ($content === null): ?>
	<div class="alert-error">CakeResque plugin not found</div>
<?php else:
	echo $this->Toolbar->message('', __d('debug_kit_ex', 'No jobs activities'));
endif; ?>