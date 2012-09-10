<?php
/**
 * DebugKitEx Nosql Panel View
 *
 * Display NoSql Logs for the NoSql Datasource
 *
 * Copyright (c) 2012, Wan Chen aka Kamisama
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

	$logs = NoSql::Redis()->getLogs();
	$headers = array('Query', 'Took (ms)');

?>
<style type="text/css">
	.no-sql-query td {font-family:Monaco,'Consolas',"Courier New",Courier,monospaced}
</style>
<h2><?php echo __d('debug_kit_ex', 'NoSql Logs')?></h2>
<?php if (!empty($logs['logs'])) : ?>

	<div class="sql-log-panel-query-log no-sql-query">
		<h4><?php echo __d('debug_kit_ex', 'Redis Log');?></h4>
		<h5><?php echo __d('debug_kit_ex', 'Total time : %s ms <br />Total Queries: %s queries', $logs['time'], $logs['count']);?></h5>
		<?php echo $this->Toolbar->table($logs['logs'], $headers, array('title' => 'NOSQL Log Redis')); ?>
	</div>

<?php else:
	echo $this->Toolbar->message('', __d('debug_kit_ex', 'No Nosql activities'));
endif; ?>