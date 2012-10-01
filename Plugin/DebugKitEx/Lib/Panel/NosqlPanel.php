<?php
/**
 * DebugKitEx Nosql Panel Class
 *
 * Add a NoSql Panel to the debug kit plugin,
 * displaying Nosql queries
 *
 * See <https://github.com/cakephp/debug_kit> for DebugKit Plugin for CakePHP
 *
 * PHP 5
 * CakePHP 2.2 and older
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
 * @since 		2.2.0
 * @license 	MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Add a Nosql Panel to the debug kit plugin,
 * displaying  nosql queries
 *
 * @package DebugKitEx
 * @subpackage DebugKitEx.vendors
 */
class NosqlPanel extends DebugPanel
{

	public $plugin = 'DebugKitEx';

	public $priority = 0;

	public $css = array('DebugKitEx.debug_kit_ex.css');

	/**
	 * Prepare output vars before Controller Rendering.
	 *
	 * @param object $controller Controller reference.
	 * @return void
	 */
	public function beforeRender(Controller $controller) {
		$content = NoSql::getLogs();
		$count = 0;
		$time = 0;
		foreach ($content as $logs) {
			$count += $logs['count'];
			$time += $logs['time'];
		}

		if ($count === 0) {
			$this->title = __d('debug_kit_ex', '<b>%d</b> NoSql', $count);
		} else {
			$this->title = __d('debug_kit_ex', '<b>%dms / %d</b> NoSql', $time, $count);
		}
		return $content;
	}
}
