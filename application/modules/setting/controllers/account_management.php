<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Account_management extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	function types($id){
	if($id==1){
		return 'Superadmin';
	}elseif($id==2){
		return 'Admin';
	}elseif($id==3){
		return 'Staff';
	}elseif($id==4){
		return 'Parent';
	}
	}	

	function refid($type,$id){
		$CI =& get_instance();
		if($type!=4){
			return $CI->db->query("select name from staff where id = '$id'")->row()->name;
		}else{
			return $CI->db->query("select name from parent where id = '$id'")->row()->name;
		}
	}

	function status($id){
		if($id==1){
			return 'Active';
		}elseif($id==0){
			return 'Inactive';
		}
	}
	
	public function index(){
		//die(md5('123456'));
		$data['subhead']= 'Setting ';
		$data['head']   = 'Account Management';
		$data['icon']	= '<span class="iconfa-cog"></span>';
		$data['org']	= $this->db->query("select * from user_login where type!=1")->result();
		$data['orgz']	= $this->db->query("select * from organization")->result();
		$this->page->view('act_mgt_index',$data);	
	}
	
	function form($id = ''){
		$this->page->view('region_form');
	}
	
	function add(){
		$this->form();
	}
	
	function save(){
		if($this->input->post('type')=='4'){
			$ref = $this->input->post('parent');
		}else{
			$ref = $this->input->post('staff');
		}
		$data = array(
			'email'		=> $this->input->post('email'),
			'password'	=> md5($this->input->post('pass1')),
			'plain_password' => $this->input->post('pass1'),
			'type'		=> $this->input->post('type'),
			'ref_id'	=> $ref,
			'status'	=> 1,
			'org_id'	=> $this->input->post('org')
			);
		if($this->input->post('id')==''){
			$this->db->insert('user_login',$data);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('user_login',$data);
		}
		$a = $this->db->query("select * from user_login where type != 1")->result();
		$data = '';
		$no = 1;
		foreach($a as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->email.'</td>
						<td>'.$this->types($row->type).'</td>
						<td>'.$this->refid($row->type,$row->ref_id).'</td>
						<td>'.$this->status($row->status).'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
			';
		$no++; }
		echo $data;
	}
	
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('user_login');
		$a = $this->db->query("select * from user_login where type != 1")->result();
		$data = '';
		$no = 1;
		foreach($a as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->email.'</td>
						<td>'.$this->types($row->type).'</td>
						<td>'.$this->refid($row->type,$row->ref_id).'</td>
						<td>'.$this->status($row->status).'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
			';
		$no++; }
		echo $data;
	}
	
	function get_staff($org){
		$a = $this->db->query("select * from staff where org_code = '$org'")->result();
		$data = '<option value="">-- Select Staff</option>';
		foreach($a as $row){
			$data .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		echo $data;
	}
	
	function get_parent(){
		$a = $this->db->query("select * from parent")->result();
		$data = '<option value="">-- Select Parent --</option>';
		foreach($a as $row){
			$data .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		echo $data;
	}
	
	function get_parent_email($id){
		$a = $this->db->query("select email from parent where id='$id'")->row();
		echo json_encode($a);
	}
	
	function get_account($id){
		$a = $this->db->query("select * from user_login where id = '$id'")->row();
		echo json_encode($a);
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */