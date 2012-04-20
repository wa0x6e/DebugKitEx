<?php
/**
 * DebugKitEx Cache Panel View
 *
 * Copyright (c) 2012, Wan Chen aka Kamisama
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright 	Copyright (c) 2012, Wan Chen aka Kamisama
 * @link 		http://cakephp.org CakePHP(tm) Project
 * @package 	DebugKitEx
 * @version 	0.1
 * @license 	MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

	$configs = Cache::configured();
	$content = array();
	foreach($configs as $config)
	{
		$engine = Cache::settings($config);
		$content[$config] = array('settings' => $engine, 'logs' => Cache::logs($config));
	}
	
?>
<style type="text/css">
	.debug_ex-table .type{width: 20%;font-weight: bold}
	.read{color: #999}
	.set{color:#999;font-style:italic}
	.delete{color: #e8665e}
	.missed td{background-color: #ff6167!important;color:#fff}
</style>

<h2><?php echo __d('debug_kit_ex', 'Cache Logs')?></h2>
<?php if (!empty($content)) : ?>
	<?php foreach ($content as $name => $datas): ?>
	<div class="sql-log-panel-query-log">
		<h4><?php echo $name ?> <span class="set">(<?php echo $datas['settings']['engine']; ?>)</span></h4>
		<?php
			
			if (!empty($datas['logs']))
			{
				echo '<table class="debug-table debug_ex-table">';
				echo '<tr>';
				echo '<th>'.__d('debug_kit_ex', 'Type').'</th>';
				echo '<th>'.__d('debug_kit_ex', 'Keyname').'</th>';
				echo '</tr>';
				
				foreach($datas['logs'] as $log)
				{
					echo '<tr class="' . (!$log['success'] ? 'missed' : '') . ' ' . $log['type'] . '">';
					echo '<td class="type">'.$log['type']. (!$log['success'] ? ' (missed)' : '') .'</td>';
					echo '<td>'.$log['key']. '</td>';
					echo '</tr>';
				}
				
				echo '</table>';
			}
			else echo '<p class="info">' .__d('debug_kit_ex', 'No cache activities') . '</p>';
		 ?>
		
	</div>
	<?php endforeach; ?>
<?php else:
	echo $this->Toolbar->message('Warning', __d('debug_kit_ex', 'No configured cache'));
endif; ?>