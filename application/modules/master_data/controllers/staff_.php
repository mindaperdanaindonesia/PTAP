<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Staff extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		$data['subhead']= 'Master Data ';
		$data['head']   = 'Staff';
		$data['icon']	= '<span class="iconfa-folder-close"></span>';
		$data['org']	= $this->db->query("select a.*,b.name as schname from staff a join organization b on a.org_code = b.id")->result();
		$data['orgz']	= $this->db->query("select * from organization order by name")->result();
		$this->page->view('staff_index',$data);	
	}
	
	function add(){
		$this->form();
	}
	
	function role($id){
	if($id==1){
		return 'Headmaster';
	}elseif($id==2){
		return 'Staff / Teacher';
	}
}
	
	function save(){
		$data  = array(
		'org_code'		=> $this->input->post('organization'),
		'nik'			=> $this->input->post('nik'),
		'name'			=> $this->input->post('name'),
		'role'			=> $this->input->post('role'),
		'chg_by'		=> '',
		'chg_date'		=> date('Y-m-d h:i:s')
		);
		if($this->input->post('id')==''){
			$this->db->insert('staff',$data);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('staff',$data);
		}
		$q = $this->db->query("select a.*,b.name as schname from staff a join organization b on a.org_code = b.id")->result();
		$data = '';
		$no = 1;
		foreach($q as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->schname.'</td>
						<td>'.$row->nik.'</td>
						<td>'.$row->name.'</td>
						<td>'.$this->role($row->role).'</td>
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
		$this->db->query("delete from staff where id = '$id'");
		$q = $this->db->query("select a.*,b.name as schname from staff a join organization b on a.org_code = b.id")->result();
		$data = '';
		$no = 1;
		foreach($q as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->schname.'</td>
						<td>'.$row->nik.'</td>
						<td>'.$row->name.'</td>
						<td>'.$this->role($row->role).'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
			';
		$no++; }
		echo $data;
	}
	
	function get_staff($id){
		$a = $this->db->query("select * from staff where id='$id'")->row();
		echo json_encode($a);
	}
	
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */