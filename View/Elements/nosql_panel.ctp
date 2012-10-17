<?php
/**
 * DebugKitEx Nosql Panel View
 *
 * Display NoSql Logs for the NoSql Datasource
 *
 * Copyright (c) 2012, Wan Qi Chen (kamisama)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author 		Wan Qi Chen <kami@kamisama.me>
 * @copyright 	Copyright 2012, Wan Qi Chen <kami@kamisama.me>
 * @link 		https://github.com/kamisama/DebugKitEx
 * @package 	DebugKitEx
 * @subpackage 	DebugKitEx.View.Elements
 * @since 		2.2.0
 * @license 	MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

	$headers = array('Query', 'Took (ms)');

?>
<h2><?php echo __d('debug_kit_ex', 'NoSql Logs')?></h2>
<?php if (!empty($content)) :
	foreach ($content as $name => $logs) :
?>

	<div class="sql-log-panel-query-log no-sql-query">
		<div class="head-bloc">
			<h4><?php echo __d('debug_kit_ex', '%s Log', $name);?></h4>
		</div>

		<?php
			echo '<table class="debug-table">';
			echo '<tr>';
			echo '<th>'.__d('debug_kit_ex', 'Command').'</th>';
			echo '<th class="time">'.__d('debug_kit_ex', 'Took (ms)').'</th>';
			echo '</tr>';

			foreach($logs['logs'] as $log)
			{
				echo '<tr>';
				echo '<td>'.$log['command'].'</td>';
				echo '<td class="time">'. $log['time']. '</td>';
				echo '</tr>';
			}


			echo '<tr class="table-summary">';
			echo '<td>';
			echo __dn('debug_kit_ex', '%s query', '%s queries', $logs['count'], $logs['count']);
			echo '</td>';
			echo '<td class="time">';
			echo $logs['time'];
			echo ' ms</td>';
			echo '</tr>';

			echo '</table>';

		?>
	</div>

<?php endforeach;
elseif ($content === null): ?>
	<div class="alert-error">NoSql plugin not found</div>
<?php else:
	echo $this->Toolbar->message('', __d('debug_kit_ex', 'No Nosql activities'));
endif; ?>