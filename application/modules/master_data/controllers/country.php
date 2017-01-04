<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Country extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		$data['subhead']= 'Master Data ';
		$data['head']   = 'Country';
		$data['icon']	= '<span class="iconfa-folder-close"></span>';
		$data['org']	= $this->db->query("select * from country order by country_name")->result();
		$this->page->view('country_index',$data);	
	}
	
	function form($id = ''){
		$this->page->view('country_form');
	}
	
	function add(){
		$this->form();
	}
	
	function save(){
		$code		= $this->input->post('country_code');
		$name		= $this->input->post('country_name');
		if($this->input->post('id')==''){
			$data = array(
			'country_code'	=> $code,
			'country_name'	=> $name
			);
			$this->db->insert('country',$data);
		}else{
			$data = array(
			'country_code'	=> $code,
			'country_name'	=> $name
			);
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('country',$data);
		}
	}
	
	function check_code($code){
		$this->db->where('country_code',$code);
		echo $this->db->get('country')->num_rows();
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
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */