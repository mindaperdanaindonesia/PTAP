<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Parents extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		$data['subhead']= 'Master Data ';
		$data['head']   = 'Parent';
		$data['icon']	= '<span class="iconfa-user"></span>';
		$data['parent']	= $this->db->query("select * from parent")->result();
		$this->page->view('parent_index',$data);	
	}
	
	function add(){
		$this->form();
	}
	
	function save(){
		$data  = array(
		'name'			=> $this->input->post('name'),
		'email'			=> $this->input->post('email'),
		'mobile'		=> $this->input->post('hp'),
		'chg_by'		=> '',
		'chg_date'		=> date('Y-m-d h:i:s')
		);
		if($this->input->post('id')==''){
			$this->db->insert('parent',$data);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('parent',$data);
		}
		$q = $this->db->query("select * from parent")->result();
		$data = '';
		$no = 1;
		foreach($q as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->name.'</td>
						<td>'.$row->email.'</td>
						<td>'.$row->mobile.'</td>
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
		$this->db->query("delete from parent where id = '$id'");
		$q = $this->db->query("select * from parent")->result();
		$data = '';
		$no = 1;
		foreach($q as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->name.'</td>
						<td>'.$row->email.'</td>
						<td>'.$row->mobile.'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
			';
		$no++; }
		echo $data;
	}
	
	function get_parent($id){
		$a = $this->db->query("select * from parent where id='$id'")->row();
		echo json_encode($a);
	}
	
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */