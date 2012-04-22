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
 * @copyright 	Copyright (c) 2012, Wan Chen aka Kamisama
 * @link 		https://github.com/kamisama/DebugKitEx
 * @package 	DebugKitEx
 * @subpackage 	DebugKitEx.View.Elements
 * @version 	0.1
 * @license 	MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

	$logs = NoSql::Redis()->logs();
	$headers= array('Query');

?>
<style type="text/css">
	.no-sql-query td {font-family:Monaco,'Consolas',"Courier New",Courier,monospaced}
</style>
<h2><?php echo __d('debug_kit_ex', 'NoSql Logs')?></h2>
<?php if (!empty($logs)) : ?>
	
	<div class="sql-log-panel-query-log no-sql-query">
		<h4><?php echo __d('debug_kit_ex', 'Redis Log');?></h4>
		<h5><?php echo __d('website', 'Total Queries: %s queries', count($logs));?></h5>
		<?php echo $this->Toolbar->table($logs, $headers, array('title' => 'NOSQL Log Redis')); ?>
	</div>

<?php else:
	echo $this->Toolbar->message('Warning', __d('debug_kit_ex', 'No Nosql activities'));
endif; ?>