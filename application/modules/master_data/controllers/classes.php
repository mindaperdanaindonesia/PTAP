<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Classes extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		$data['subhead']	= 'Master Data ';
		$data['head']  		= 'Class';
		$data['icon']		= '<span class="iconfa-home"></span>';
		$data['class']		= $this->db->query("select a.*,b.name as schname from class_master a join organization b on a.org_id = b.id")->result();
		$data['class_mng']	= $this->db->query("select a.*,b.name as schname from class a join organization b on a.org_code = b.id")->result();
		$data['org']		= $this->db->query("select * from organization order by name")->result();
		$this->page->view('classes_index',$data);	
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
		'org_id'		=> $this->input->post('organization'),
		'class_name'			=> $this->input->post('class')
		);
		if($this->input->post('id')==''){
			$this->db->insert('class_master',$data);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('class_master',$data);
		}
		$q = $this->db->query("select a.*,b.name as schname from class_master a join organization b on a.org_id = b.id")->result();
		$data = '';
		$no = 1;
		foreach($q as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->schname.'</td>
						<td>'.$row->class_name.'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						<a onclick=\'get_member("'.$row->id.'","'.$row->org_id.'")\' data-toggle=\'modal\' href="#manage" class="btn btn-info btns" style="color:white"><i class="icon-cog icon-white"></i> Manage Class Member</a>
						</td>
					</tr>
			';
		$no++; }
		echo $data;
	}
	
	function delete($id){
		$this->db->query("delete from class_master where id = '$id'");
		$q = $this->db->query("select a.*,b.name as schname from class_master a join organization b on a.org_id = b.id")->result();
		$data = '';
		$no = 1;
		foreach($q as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->schname.'</td>
						<td>'.$row->class_name.'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						<a onclick=\'get_member("'.$row->id.'","'.$row->org_id.'")\' data-toggle=\'modal\' href="#manage" class="btn btn-info btns" style="color:white"><i class="icon-cog icon-white"></i> Manage Class Member</a>
						</td>
					</tr>
			';
		$no++; }
		echo $data;
	}
	
	function get_class($id){
		$a = $this->db->query("select * from class_master where id='$id'")->row();
		echo json_encode($a);
	}
	
	function get_free_student($org_id){
		$q = $this->db->query("select a.*,b.pupil_id from student a left join class b on a.id = b.pupil_id where b.pupil_id is null and a.org_code='$org_id'")->result();
		$data = '';
		foreach($q as $row){
			$data .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		echo $data;
	}	
	
	function get_class_member($id){
		$q = $this->db->query("select a.* from student a join class b on a.id = b.pupil_id and b.class_id='$id'")->result();
		$data = '';
		foreach($q as $row){
			$data .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		echo $data;
	}	
	
	function std_trans(){
		$org_id = $this->input->post('org');
		$std    = $this->input->post('std');
		$class	= $this->input->post('cls');
		for($no = 0; $no<=sizeof($std)-1;$no++){
			$data = array(
			'cont_no'		=> 0,
			'org_code'		=> $org_id,
			'class_id'		=> $class,
			'pupil_id'		=> $std[$no],
			'status'		=> '1',
			'chg_by'		=> '',
			'chg_date'		=> date('Y-m-d h:i:s')
			);
			$this->db->insert('class',$data);
		}
	}
	
	function std_del(){
		$org_id = $this->input->post('org');
		$std    = $this->input->post('std');
		$class	= $this->input->post('cls');
		for($no = 0; $no<=sizeof($std)-1;$no++){
			$this->db->where('pupil_id',$std[$no]);
			$this->db->delete('class');
		}
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */