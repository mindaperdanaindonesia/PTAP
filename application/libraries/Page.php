<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Page {

	private $_CI;							// instance of CodeIgniter Class
	private $_dir			= FALSE;		// wheter the controller use directory or not
	private $_base_url;						// page Base URL
	private $_data			= array();		// data variables sent to View Class
	private $_header		= '';			// page header
	private $_menu			= '';			// page menu
	private $_menubawah		= '';			// page menu bawah
	private $_content		= '';			// page content
	private $_template		= 'template';	// default template
	private $_title 		= '';			// page title
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 * 
	 * Creates CI Class instance
	 */
	public function __construct() {
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '1024M');
		$this->_CI =& get_instance();
		

		
		// define page base URL
		$first = $this->_CI->uri->segment(1);
		$second	= '';
		
		if ($first == '') {
			$first = $this->_CI->router->class;
		}
		else {
			$second	= $this->_CI->uri->segment(2);
		}
		
		$this->_base_url = $this->_dir ? site_url($first.'/'.$second) : site_url($first);
		
		if($this->_CI->uri->segment(1)!='dashboard'){
			$this->_menu = 'template/menu_'.$this->_CI->uri->segment(1);
		}
		else{
				$this->_menu = 'template/menu';
		}
	
		$this->_menubawah = 'template/menubawah';
		$this->_header = 'template/header';
		
		// others
		$this->_CI->load->library('user_agent');
		$prev = $this->_CI->agent->referrer();
		$this->_back = $prev == '' ? $this->_base_url : $prev;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get page base URL
	 *
	 * @return	string
	 */
	function base_url($uri = '') {
		// check first slash
		if ($uri != '') {
			if ($uri[0] != '/') {
				$uri = '/'.$uri;
			}
		}
		
		// return the base URL
		return $this->_base_url.$uri;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * use_directory
	 *
	 */
	function use_directory() {
		$this->_dir = TRUE;
		$dir = $this->_CI->uri->segment(1);
		$controller	= $this->_CI->uri->segment(2);
		$this->_base_url = site_url($dir.'/'.$controller);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set the title
	 *
	 * @param	string
	 */
	function title($title) {
		$this->_title = $title;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set data sent to view class
	 *
	 * @param	array
	 */
	function _data($values)	{
		foreach ($values as $key => $value) {
			$this->_data[$key] = $value;
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * Set header of the page
	 *
	 * @param	string
	 */
	function _header() {
		return $this->_header;
	}
	
	/**
	 * Set menu of the page
	 *
	 * @param	string
	 */
	function _menu(){
		return $this->_menu;
	}
	
		/**
	 * Set menu of the page
	 *
	 * @param	string
	 */
	function _menubawah(){
		return $this->_menubawah;
	}
	/**
	 * Set content of the page
	 *
	 * @param	string
	 */
	function _content($content) {
		$this->_content = $content;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set template
	 *
	 * @param	string
	 */
	function template($template) {
		$this->_template = $template;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set data for template
	 */
	function _set_data() {
		foreach ($this as $key => $value) {
			if ($key != '_CI' && $key != '_data') {
				$key = substr($key, 1);
				$this->_data[$key] = $value;
			}
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Display the page
	 */
	function view($content = 'template/dashboard',$data = array()) {
		$this->_header();
		$this->_menu();
		$this->_menubawah();
		$this->_content($content);
		$this->_data($data);
		
		$this->_set_data();
		$this->_CI->load->view('template/'.$this->_template, $this->_data);
	}
	
}
 
// END MY_Page class

/* End of file Page.php */
/* Location: ./application/libraries/Page.php */