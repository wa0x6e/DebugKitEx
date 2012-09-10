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

	$content = CakeResque::$logs;

?>
<style>
	.debug_ex-table td
	{
		vertical-align: top;
	}
</style>
<h2><?php echo __d('debug_kit_ex', 'Resque Jobs Logs')?></h2>
<?php if (!empty($content)) : ?>
	<?php foreach ($content as $queue => $jobs): ?>
	<div class="sql-log-panel-query-log">
		<h4>Queue: <?php echo $queue ?></h4>
		<?php

			if (!empty($jobs))
			{
				echo '<table class="debug-table debug_ex-table">';
				echo '<tr>';
				echo '<th>'.__d('debug_kit_ex', 'Job Class').'</th>';
				echo '<th>'.__d('debug_kit_ex', 'Method').'</th>';
				echo '<th>'.__d('debug_kit_ex', 'Arguments').'</th>';
				echo '<th>'.__d('debug_kit_ex', 'From').'</th>';
				echo '</tr>';

				foreach($jobs as $job)
				{
					echo '<tr>';
					echo '<td>'.$job['class']. '</td>';
					echo '<td>'.$job['method']. '</td>';
					echo '<td><code>'.var_export($job['args'], true). '</code></td>';
					echo '<td>' . sprintf('%s <span class="trace_line">line %s</span>', str_replace(APP, '', $job['caller'][0]['file']), $job['caller'][0]['line']) . '</td>';
					echo '</tr>';
				}

				echo '</table>';
			}
		 ?>

	</div>
	<?php endforeach; ?>
<?php else:
	echo $this->Toolbar->message('Warning', __d('debug_kit_ex', 'No jobs'));
endif; ?>