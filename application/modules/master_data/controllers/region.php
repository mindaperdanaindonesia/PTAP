<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Region extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		$data['subhead']= 'Master Data ';
		$data['head']   = 'Region';
		$data['icon']	= '<span class="iconfa-folder-close"></span>';
		$data['country']=$this->db->query("select * from country order by country_name")->result();
		$data['org']	= $this->db->query("select a.*,b.country_name from region a join country b on a.country_code = b.country_code order by a.region_name")->result();
		$this->page->view('region_index',$data);	
	}
	
	function form($id = ''){
		$this->page->view('region_form');
	}
	
	function add(){
		$this->form();
	}
	
	function save(){
		$code		= $this->input->post('region_code');
		$name		= $this->input->post('region_name');
		$newcode	= date('Ymdhis');
		if($this->input->post('id')==''){
			$data = array(
			'region_code'	=> $code,
			'region_name'	=> $name,
			'country_code'	=> $this->input->post('country')
			);
			//var_dump($data);exit; 
			$this->db->insert('region',$data);
		}else{
			$data = array(
			'region_code'	=> $code,
			'region_name'	=> $name
			);
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('region',$data);
		}
	}
	
	function check_code($code){
		$this->db->where('region_code',$code);
		echo $this->db->get('region')->num_rows();
	}
	
	function get_region(){
		$a = $this->db->query('select a.*,b.country_name from region a join country b on a.country_code = b.country_code order by a.region_name')->result();
		$data = "";
		$no = 1;
		foreach($a as $row){
			$data .= '
			<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->country_name.'</td>
						<td>'.$row->region_code.'</td>
						<td>'.$row->region_name.'</td>
						<td>
						<a data-toggle="modal" href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
			';
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
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */