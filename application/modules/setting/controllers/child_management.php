<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Child_management extends MX_Controller {
	
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
		$data['head']   = 'Child Management';
		$data['icon']	= '<span class="iconfa-user"></span>';
		$data['child']	= $this->db->query("select a.*,b.id as std_id,b.name as cname,e.name as oname,d.class_name
											from parent a
											join student b on a.id = b.parent_id
											join organization e on b.org_code = e.id
											left join class c on b.id = c.pupil_id
											left join class_master d on c.class_id = d.id
											")->result();
		$data['parent']	= $this->db->query("select * from parent order by name")->result();
		$data['orgs']	= $this->db->query("select * from organization order by name")->result();
		$this->page->view('child_mgt_index',$data);	
	}
	
	function form($id = ''){
		$this->page->view('region_form');
	}
	
	function add(){
		$this->form();
	}
	
	function save(){
		$data = array(
		'parent_id'	=> $this->input->post('parent')
		);
		$this->db->where('id',$this->input->post('child'));
		$this->db->update('student',$data);
		$a = $this->db->query("select a.*,b.id as std_id,b.name as cname,e.name as oname,d.class_name
											from parent a
											join student b on a.id = b.parent_id
											join organization e on b.org_code = e.id
											left join class c on b.id = c.pupil_id
											left join class_master d on c.class_id = d.id
											")->result();
		$data = '';
		$no   = 1;
		foreach($a as $row){
			$data .= '<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->name.'</td>
						<td>'.$row->cname.'</td>
						<td>'.$row->oname.'</td>
						<td>'.$row->class_name.'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->std_id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
				   	  </tr>';
		$no++; }
		echo $data;
	}
	
	function row_region($id){
		$a = $this->db->query("select * from region where id='$id'")->row();
		echo json_encode($a);
	}
	
	function del_region($id){
		$this->db->where('id',$id);
		$this->db->delete('region');
	}
	
	function get_student($id){
		$a = $this->db->query("select * from student where org_code = '$id' and parent_id is null")->result();
		$data  = '<option value="">-- Select Child --</option>';
		foreach($a as $row){
			$data .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		echo $data;
	}
	
	function get_students($id,$std){
		$a = $this->db->query("select * from student where (org_code = '$id' and parent_id is null) or id = '$std'")->result();
		$data  = '<option value="">-- Select Child --</option>';
		foreach($a as $row){
			$data .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		echo $data;
	}
	
	function get_childs($id){
		$a = $this->db->query("select a.id,b.id as std_id,b.org_code
											from parent a
											join student b on a.id = b.parent_id where b.id = '$id'")->row();
		echo json_encode($a);
	}
	
	function delete($id){
		$this->db->query("update student set parent_id = null");
		$a = $this->db->query("select a.*,b.id as std_id,b.name as cname,e.name as oname,d.class_name
											from parent a
											join student b on a.id = b.parent_id
											join organization e on b.org_code = e.id
											left join class c on b.id = c.pupil_id
											left join class_master d on c.class_id = d.id
											")->result();
		$data = '';
		$no   = 1;
		foreach($a as $row){
			$data .= '<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->name.'</td>
						<td>'.$row->cname.'</td>
						<td>'.$row->oname.'</td>
						<td>'.$row->class_name.'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->std_id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
				   	  </tr>';
		$no++; }
		echo $data;
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */