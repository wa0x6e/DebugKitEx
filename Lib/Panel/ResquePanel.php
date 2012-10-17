<?php
/**
 * DebugKitEx Resque Panel Class
 *
 * Add a Resque Panel to the debug kit plugin,
 * displaying resque jobs enqueuing
 *
 * See <https://github.com/cakephp/debug_kit> for DebugKit Plugin for CakePHP
 *
 * PHP 5
 * CakePHP 2.2 and older
 *
 * Copyright (c) 2012, Wan Qi Chen (Kamisama)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author 		Wan Qi Chen <kami@kamisama.me>
 * @copyright 	Copyright 2012, Wan Qi Chen <kami@kamisama.me>
 * @link 		https://github.com/kamisama/DebugKitEx
 * @package 	DebugKitEx
 * @since 		2.2.1
 * @license 	MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Add a Cache Panel to the debug kit plugin,
 * displaying resque jobs enqueuing
 *
 * @package DebugKitEx
 * @subpackage DebugKitEx.vendors
 */
class ResquePanel extends DebugPanel
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
		if (!class_exists('CakeResque') || !property_exists('CakeResque', 'logs')) {
			return null;
		}

		$logs =  CakeResque::$logs;
		$count = 0;
		foreach ($logs as $l) {
			$count += count($l);
		}

		if ($this->priority > 0) {
			$this->title = __dn('debug_kit_ex', '<b>%d</b> job', '<b>%d</b> jobs', $count, $count);
		}
		return $logs;
	}
}
