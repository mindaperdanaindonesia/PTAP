<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class School_profile extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		$data['subhead']= 'Master Data ';
		$data['head']   = 'School Profile';
		$data['icon']	= '<span class="iconfa-briefcase"></span>';
		$data['org']	= $this->db->query("select * from school_profile")->result();
		$this->page->view('school_profile_index',$data);	
	}
	
	function form($id = ''){
		$data['subhead']= 'Master Data ';
		$data['head']   = 'Create School Profile';
		$data['icon']	= '<span class="iconfa-briefcase"></span>';
		if($id==''){
			$data['data']	= array(
			'id'		=> '',
			'org_code'	=> '',
			'type'		=> '',
			'url'		=> '',
			'profile'	=> ''
			);
		$data['org']	= $this->db->query("select a.*,b.org_code from organization a left join school_profile b on a.id = b.org_code where b.org_code is null order by a.name")->result();
		}else{
			$data['data']	= $this->db->query("select * from school_profile where id='$id'")->row_array();
			$data['org']	= $this->db->query("select a.*,b.org_code from organization a left join school_profile b on a.id = b.org_code where b.org_code is null or b.org_code = '".$data['data']['org_code']."' order by a.name")->result();	
		}
		$this->page->view('school_profile_form',$data);
	}
	
	function add(){
		$this->form();
	}
	
	function edit($id){
		$this->form($id);
	}
	
	function save(){
		$data = array(
		'org_code'	=> $this->input->post('org'),
		'type'		=> $this->input->post('type'),
		'url'		=> $this->input->post('url'),
		'profile'	=> $this->input->post('page_content')
		);
		if($this->input->post('id')==''){
		$this->db->insert('school_profile',$data);
		}else{
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('school_profile',$data);
		}
		redirect('master_data/school_profile');
	}
	
	function get_country(){
		$a = $this->db->query('select * from country order by country_name')->result();
		$data = "";
		$no = 1;
		foreach($a as $row){
			$data .= '
			<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->country_code.'</td>
						<td>'.$row->country_name.'</td>
						<td>
						<a data-toggle="modal" href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
			';
		$no++; }
		echo $data;
	}    
	
	function row_country($id){
		$a = $this->db->query("select * from country where id='$id'")->row();
		echo json_encode($a);
	}
	
	function del_country($id){
		$this->db->where('id',$id);
		$this->db->delete('country');
	}
	
	function get_region($code){
		$a = $this->db->query("select * from region where country_code = '$code'")->result();
		$no = 1;
		foreach($a as $row){
			$button = "<button  data-dismiss=\"modal\" aria-hidden=\"true\" type=\"button\" class=\"btn btn-primary\" onclick=\"setregion('".$row->region_code."-".$row->region_name."')\"><span class=\"icon-plus icon-white\"></span></button>";
			$data[] = array($no,$row->region_name,$button);
		$no++; }
		echo json_encode($data);
	}
	
	function get_city($code){
		$a = $this->db->query("select * from city where region_code = '$code'")->result();
		$no = 1;
		foreach($a as $row){
			$button = "<button  data-dismiss=\"modal\" aria-hidden=\"true\" type=\"button\" class=\"btn btn-primary\" onclick=\"setcity('".$row->city_code."-".$row->city_name."')\"><span class=\"icon-plus icon-white\"></span></button>";
			$data[] = array($no,$row->city_name,$button);
		$no++; }
		echo json_encode($data);
	}
	
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('school_profile');
		redirect('master_data/school_profile');
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */