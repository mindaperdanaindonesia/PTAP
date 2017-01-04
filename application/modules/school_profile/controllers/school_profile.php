<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class School_profile extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	function shows($id){
		$data['subhead']	= 'PTAP ';
		$data['head']   	= 'School Profile';
		$data['icon']		= '<span class="iconfa-briefcase"></span>';
		$data['sprofile']	= $this->db->query("select * from school_profile where org_code = '$id'")->row();
		$this->page->view('school_profile',$data);
	}
	
	public function index(){
		$this->page->view('school_profile_blank');
	}
		
	
	public function show_profile(){
		$data['subhead']= 'PTAP ';
		$data['head']   = 'School Profile';
		$data['icon']	= '<span class="iconfa-briefcase"></span>';
		if($this->session->userdata('level')==1){
			$data['sprofile'] = $this->db->query("select * from school_profile")->result();
			$this->page->view('school_profile_all',$data);	
		}else{
			//$data['sprofile'] = $this->db->query("select * from school_profile where org_id = '".$this->session->userdata('org_id')."'")->row();
			//$this->page->view('school_profile',$data);	
			$this->shows($this->session->userdata('org_id'));
		}
		
	}
	
	function show($id){
		$data['subhead']= 'PTAP ';
		$data['head']   = 'School Profile';
		$data['icon']	= '<span class="iconfa-briefcase"></span>';
		
	}
	
	function form($id = ''){
		$data['subhead']= 'Notification';
		$data['head']   = 'Create Broadcast Message';
		$data['icon']	= '<span class="iconfa-envelope"></span>';
		$this->page->view('broadcast_form',$data);
	}
	
	function add(){
		$this->form();
	}
	
	function save(){
		$data = array(
		'mess_id'		=> md5(date('Ymd')),
		'org_id'		=> $this->session->userdata('org_id'),
		'class_id'		=> '1',
		'staff'			=> $this->session->userdata('staff'),
		'valid_from'	=> $this->input->post('date_from'),
		'valid_to'		=> $this->input->post('date_to'),
		'status'		=> '1',
		'mess_body'		=> $this->input->post('editor1'),
		'chg_by'		=> 'Admin',
		'chg_date'		=> date('Y-m-d')
		);
		$this->db->insert('message_header',$data);
		redirect('notofication');
	}
	
	function get_message($id){
		$row = $this->db->query("select * from message_header where mess_id = '$id'")->row();
		echo '
		<div class="msgauthor">
                                    <div class="thumb"><img src="'.base_url().'assets/images/photos/thumb1.png" alt="" /></div>
                                    <div class="authorinfo">
                                        <span class="date pull-right">'.$row->chg_date.'</span>
                                        <h5><strong>Admin</strong> <span>admin@gmail.com</span></h5>
                                        <span class="to">to '.$this->session->userdata('email').'</span>
                                    </div><!--authorinfo-->
                                </div><!--msgauthor-->
                                <div class="msgbody">
                                    '.$row->mess_body.'
                                </div><!--msgbody-->
		';
	}
	
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */