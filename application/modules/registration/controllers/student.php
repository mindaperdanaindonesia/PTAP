<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Student extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		$data['subhead']= 'Registration ';
		$data['head']   = 'Student';
		$data['icon']	= '<span class="iconfa-folder-close"></span>';
		if($this->session->userdata('level')=='1'){
		$data['org']	= array();
		}else{
		$data['org']	= $this->db->query("select a.*,b.name as schname from student a join organization b on a.org_code = b.id where a.org_code ='".$this->session->userdata('org_id')."'")->result();
		}
		$data['orgz']	= $this->db->query("select * from organization order by name")->result();
		$data['parent']	= $this->db->query("select * from parent order by name")->result();
		$this->page->view('student_index',$data);	
	}
	
	function form($id = ''){
		$data['subhead']= 'Registration ';
		$data['head']   = 'Student Form';
		$data['icon']	= '<span class="iconfa-folder-close"></span>';
		if($this->session->userdata('level')==1){
		$data['orgz']	= $this->db->query("select * from organization order by name")->result();
		}else{
		$data['orgz']	= $this->db->query("select * from organization where id = '".$this->session->userdata('org_id')."' order by name")->result();	
		}
		$data['parent']	= $this->db->query("select * from parent order by name")->result();
		$this->page->view('student_form',$data);
	}
	
	function add(){
		$this->form();
	}
	
	function save(){
		$data = array(
		'org_code'		=> $this->input->post('org'),
		'nim'			=> $this->input->post('nim'),
		'name'			=> $this->input->post('name'),
		'email'			=> $this->input->post('email'),
		'mobile'		=> $this->input->post('hp'),
		'parent_id'		=> $this->input->post('parent'),
		'status'		=> 1,
		'chg_by'		=> '',
		'chg_date'		=> date('Y-m-d h:i:s')
		);
		if($this->input->post('id')==''){
			$this->db->insert('student',$data);
			redirect('registration/student');
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('student',$data);
			$a = $this->db->query("select a.*,b.name as schname from student a join organization b on a.org_code = b.id")->result();
			$no = 1;
			$data = '';
			foreach($a as $row){
			$data .= '
						<tr style="font-size:9pt">
							<td>'.$no.'</td>
							<td>'.$row->schname.'</td>
							<td>'.$row->nim.'</td>
							<td>'.$row->name.'</td>
							<td>'.$row->mobile.'</td>
							<td>'.$row->email.'</td>
							<td>
							<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
							<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
							</td>
						</tr>
			';
			$no++; }
			echo $data;
		}
		
		/*$a = $this->db->query("select a.*,b.name as schname from student a join organization b on a.org_code = b.id")->result();
		$no = 1;
		$data = '';
		foreach($a as $row){
		$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->schname.'</td>
						<td>'.$row->nim.'</td>
						<td>'.$row->name.'</td>
						<td>'.$row->mobile.'</td>
						<td>'.$row->email.'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
		';
		$no++; }
		echo $data;*/
	}
	
	function get_student_filter($id){
		$no = 1;
		$noarr = 0;
		$a = $this->db->query("select a.*,b.name as schname from student a join organization b on a.org_code = b.id where a.org_code ='$id'")->result();
		foreach($a as $row){
			$button = '<a data-toggle="modal" href="#myModal" class="btn btn-primary btns" onclick="edit('.$row->id.')"><i class="icon-edit icon-white"></i></a>
					   <button type="button" class="btn btn-danger btns" onclick="removes('.$row->id.')"><i class="icon-remove icon-white"></i></button>';
			$data[$noarr] = array(
			$no,
			$row->schname,
			$row->nim,
			$row->name,
			$row->mobile,
			$row->email,
			$button
			);
			//$data[$noarr] = json_encode($data[$noarr]);
		$no++; $noarr++; }
		echo json_encode($data);
	}

	function delete($id){
		$this->db->query("delete from student where id = '$id'");
		$a = $this->db->query("select a.*,b.name as schname from student a join organization b on a.org_code = b.id")->result();
		$no = 1;
		$data = '';
		foreach($a as $row){
		$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->schname.'</td>
						<td>'.$row->nim.'</td>
						<td>'.$row->name.'</td>
						<td>'.$row->mobile.'</td>
						<td>'.$row->email.'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
		';
		$no++; }
		echo $data;	
	}
	
	function get_student($id){
		$a = $this->db->query("select * from student where id = '$id'")->row();
		echo json_encode($a);
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */