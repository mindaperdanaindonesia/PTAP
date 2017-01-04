<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class School extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		$data['subhead']= 'Master Data ';
		$data['head']   = 'School / Organization';
		$data['icon']	= '<span class="iconfa-briefcase"></span>';
		$data['org']	= $this->db->query("select * from organization order by name")->result();
		$this->page->view('school_index',$data);	
	}
	
	function form($id = ''){
		$data['subhead']= 'Master Data ';
		$data['head']   = 'Create School / Organization';
		$data['icon']	= '<span class="iconfa-briefcase"></span>';
		$data['country']= $this->db->query("select * from country order by country_name")->result();
		$this->page->view('school_form',$data);
	}
	
	function add(){
		$this->form();
	}
	
	function save(){
		$data = array(
		'code'			=> $this->input->post('org_code'),
		'type'			=> 1,
		'name'			=> $this->input->post('org_name'),
		'address'		=> $this->input->post('address'),
		'city'			=> $this->input->post('city_code'),
		'region'		=> $this->input->post('region_code'),
		'country'		=> $this->input->post('country_code'),
		'postal_code'	=> $this->input->post('post_code'),
		'phone'			=> $this->input->post('phone'),
		'fax'			=> $this->input->post('fax'),
		'email'			=> $this->input->post('email'),
		'contact'		=> $this->input->post('contact'),
		'status'		=> 0,
		'reg_by'		=> '',
		'reg_date'		=> date('Y-m-d h:i:s'),
		'chg_by'		=> '',
		'chg_date'		=> date('Y-m-d h:i:s')
		);
		$this->db->insert('organization',$data);
		redirect('master_data/school');
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
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */