<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Contract_management extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		//die(md5('123456'));
		$data['subhead']= 'Setting ';
		$data['head']   = 'Contract Management';
		$data['icon']	= '<span class="iconfa-edit"></span>';
		$data['cont']	= $this->db->query("select a.*,name from contract a join organization b on a.org_code = b.id")->result();
		$data['org']	= $this->db->query("select * from organization")->result();
		$this->page->view('cont_mgt_index',$data);	
	}
	
	function form($id = ''){
		$this->page->view('region_form');
	}
	
	function add(){
		$this->form();
	}
	
	function org($id){
	$CI =& get_instance();
	return $CI->db->query("select name from organization where id = '$id'")->row()->name;
	}
	
	function save(){
		$data = array(
		'cont_no'		=> $this->input->post('cont_no'),
		'org_code'		=> $this->input->post('org'),
		'year'			=> $this->input->post('year'),
		'valid_from'	=> $this->input->post('valid_from'),
		'valid_to'		=> $this->input->post('valid_to')." 23:59:59",
		'max_user'		=> $this->input->post('max_user'),
		'max_pupil'		=> $this->input->post('max_pupil')
		);
		if($this->input->post('id')==''){
			$this->db->insert('contract',$data);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('contract',$data);
		}
		$a = $this->db->query("select a.*,name from contract a join organization b on a.org_code = b.id")->result();
		$data = '';
		$no = 1;
		foreach($a as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->cont_no.'</td>
						<td>'.$this->org($row->org_code).'</td>
						<td>'.$row->year.'</td>
						<td>'.$row->valid_from.'</td>
						<td>'.$row->valid_to.'</td>
						<td>'.$row->max_user.'</td>
						<td>'.$row->max_pupil.'</td>
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
		$this->db->delete('contract');
		$a = $this->db->query("select a.*,name from contract a join organization b on a.org_code = b.id")->result();
		$data = '';
		$no = 1;
		foreach($a as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->cont_no.'</td>
						<td>'.$this->org($row->org_code).'</td>
						<td>'.$row->year.'</td>
						<td>'.$row->valid_from.'</td>
						<td>'.$row->valid_to.'</td>
						<td>'.$row->max_user.'</td>
						<td>'.$row->max_pupil.'</td>
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
	
	function get_contract($id){
		$a = $this->db->query("select * from contract where id = '$id'")->row();
		echo json_encode($a);
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */