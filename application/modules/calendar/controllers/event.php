<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Event extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		$data['subhead']= 'Event &';
		$data['head']   = 'Calendar';
		$data['icon']	= '<span class="iconfa-envelope"></span>';
		$this->page->view('calendar_index',$data);	
	}
	
	function form($id = ''){
		$this->page->view('region_form');
	}
	
	function add(){
		$this->form();
	}
	
	function get_region($code){
		$q = $this->db->query("select * from region where country_code = '$code'")->result();
		$data = '<option value="">-- Select Region --</option>';
		foreach($q as $row){
		$data .= '<option value="'.$row->region_code.'">'.$row->region_name.'</option>';	
		}
		echo $data;
	}
	
	function save(){
		$code		= $this->input->post('city_code');
		$name		= $this->input->post('city_name');
		$country    = $this->input->post('country');
		$region     = $this->input->post('region');
		$newcode	= date('Ymdhis');
		if($code==''){
			$data = array(
			'city_code'		=> $newcode,
			'city_name'		=> $name,
			'country_code'	=> $country,
			'region_code'	=> $region
			);
			//var_dump($data);exit; 
			$this->db->insert('city',$data);
		}else{
			$data = array(
			'city_code'		=> $newcode,
			'city_name'		=> $name,
			'country_code'	=> $country,
			'region_code'	=> $region
			);
			$this->db->where('city_code',$code);
			$this->db->update('city',$data);
		}
	}
	
	function get_city(){
		$a = $this->db->query("select a.*,b.region_name,c.country_name from city a join region b on a.region_code = b.region_code join country c on b.country_code = c.country_code order by a.city_name")->result();
		$data = "";
		$no = 1;
		foreach($a as $row){
			$data .= '
			<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->country_name.'</td>
						<td>'.$row->region_name.'</td>
						<td>'.$row->city_name.'</td>
						<td>
						<a data-toggle="modal" href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>';
		$no++; }
		echo $data;
	}    
	
	function row_city($id){
		$a = $this->db->query("select * from city where id='$id'")->row();
		echo json_encode($a);
	}
	
	/*function get_region($code){
		$q = $this->db->query("select * from region where country_code = '$code'")->result();
		$data = '<option value="">-- Select Region--</option>';
		foreach($q as $row){
			$data .= '<option value="'.$row->region_code.'">'.$row->region_name.'</option>'; 
		}
		echo $data;
	}*/
	
	function del_region($id){
		$this->db->where('id',$id);
		$this->db->delete('region');
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */