<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class Dashboard extends MX_Controller {			public function __construct(){		parent::__construct();		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){			redirect('auth');		}	}		public function index(){		$data['subhead']= 'Welcome Page';		$data['head']   = 'Dashboard';		$data['icon']	= '<span class="iconfa-home"></span>';		$this->page->view('template/dashboard',$data);	}	}/* End of file dashboard.php *//* Location: ./application/controllers/dashboard.php */