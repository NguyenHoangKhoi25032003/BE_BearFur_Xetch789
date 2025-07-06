<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load MX core classes */
require_once dirname(__FILE__).'/Lang.php';
require_once dirname(__FILE__).'/Config.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library extends the CodeIgniter CI_Controller class and creates an application
 * object allowing use of the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Base.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class CI extends CI_Controller
{
	public static $APP;

	public function __construct() {

		/* assign the application instance */
		self::$APP = $this;

		global $LANG, $CFG;

		/* re-assign language and config for modules */
		if ( ! $LANG instanceof MX_Lang) $LANG = new MX_Lang;
		if ( ! $CFG instanceof MX_Config) $CFG = new MX_Config;

		parent::__construct();
	}
}

/* create the application object */
new CI;

class MX_Base
{
	public $autoloader = false;
	public $config = false;
	public $errors = false;
	public $hooks = false;
	public $lang = false;
	public $loader = false;
	public $log = false;
	public $model = false;
	public $route = false;
	public $uri = false;
	public $benchmark = false;
	public $calendar = false;
	public $cart = false;
	public $database = false;
	public $db = false;
	public $email = false;
	public $encrypt = false;
	public $file = false;
	public $form_validation = false;
	public $ftp = false;
	public $image_lib = false;
	public $input = false;
	public $javascript = false;
	public $jquery = false;
	public $migration = false;
	public $number = false;
	public $output = false;
	public $pagination = false;
	public $parser = false;
	public $profiler = false;
	public $session = false;
	public $table = false;
	public $trackback = false;
	public $typography = false;
	public $unit = false;
	public $upload = false;
	public $user_agent = false;
	public $xmlrpc = false;
	public $zip = false;

	public function __construct()
	{
		$class = str_replace(CI::$APP->config->item('subclass_prefix'), '', get_class($this));
		log_message('debug', $class." MX_Base Initialized");
		Modules::$registry[strtolower($class)] = $this;

		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);

		/* autoload module items */
		$this->load->_autoloader($this);
	}

	public function __get($class)
	{
		return CI::$APP->$class;
	}
}
