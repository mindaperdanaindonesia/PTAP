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
		$data['subhead']= 'Registration';
		$data['head']   = 'School / Organization';
		$data['icon']	= '<span class="iconfa-briefcase"></span>';
		$data['org']	= $this->db->query("select * from organization where status !=4 order by name")->result();
		$this->page->view('school_index',$data);	
	}
	
	function form($id = '', $act = ''){
		$data['subhead']= 'Registration ';
		$data['head']   = 'Create School / Organization';
		$data['icon']	= '<span class="iconfa-briefcase"></span>';
		$data['act']	= $act;
		$data['country']= $this->db->query("select * from country order by country_name")->result();
		//die($act);
		if($act == 'add'){
			$data['data'] = array(
			'id'			=> '',
			'code'			=> '',
			'type'			=> '',
			'name'			=> '',
			'address'		=> '',
			'postal_code'	=> '',
			'phone'			=> '',
			'fax'			=> '',
			'email'			=> '',
			'contact'		=> '',
			'status'		=> '',
			'country_code'	=> '',
			'country_name'	=> '',
			'region_code'	=> '',
			'region_name'	=> '',
			'city_code'		=> '',
			'city_name'		=> ''
			);
			$this->page->view('school_form',$data);
		}else{
			$data['data'] = $this->db->query("select a.*,b.country_code,b.country_name,c.region_code,c.region_name,d.city_code,d.city_name from organization a
			left join country b on a.country = b.country_code
			left join region c on a.region = c.region_code
			left join city d on a.city = d.city_code
			where a.id = '$id'")->row_array();
			$this->page->view('school_form',$data);
		}	
	}
	
	function add(){
		$this->form('','add');
	}
	
	function confirm($code){
		/*$data['subhead']= 'Registration ';
		$data['head']   = 'Create School / Organization';
		$data['icon']	= '<span class="iconfa-briefcase"></span>';
		$data['act']	= $act;
		$data['country']= $this->db->query("select * from country order by country_name")->result();
		$data['data'] = $this->db->query("select a.*,b.country_code,b.country_name,c.region_code,c.region_name,d.city_code,d.city_name from organization a
			left join country b on a.country = b.country_code
			left join region c on a.region = c.region_code
			left join city d on a.city = d.city_code
			where a.id = '$id'")->row();
		$this->page->view('school_confirm',$data);*/
		$id = $this->db->query("select id from organization where code = '$code'")->row()->id;
		$this->form($id,'confirm');
	}
	
	function submit_approval($id){
		$this->db->query("update organization set status = '1' where id = '$id'");
		redirect('registration/school');
	}	
	
	function activate($id){
		$this->db->query("update organization set status = '2' where id = '$id'");
		redirect('registration/school');
	}	
	
	function deactivate($id){
		$this->db->query("update organization set status = '3' where id = '$id'");
		redirect('registration/school');
	}	
	
	function del_org($id){
		$this->db->query("update organization set status = '4' where id = '$id'");
		redirect('registration/school');
	}
	
	function gen_code($code){
		$count = $this->db->query("select * from organization where code like '$code%' ")->num_rows()+1;
		//$count = 1000;
		if($count<9){
			$code = $code.'000'.$count;
		}elseif($count<99){
			$code = $code.'00'.$count;
		}elseif($count<999){
			$code = $code.'0'.$count;
		}elseif($count<9999){
			$code = $code.$count;
		}
		return $code;
	}
	
	function save(){
		if($this->input->post('org_type')=='K'){
			$type = 1;
		}elseif($this->input->post('org_type')=='P'){
			$type = 2;
		}elseif($this->input->post('org_type')=='S'){
			$type = 3;
		}elseif($this->input->post('org_type')=='H'){
			$type = 4;
		}
		if($this->input->post('id')==''){
			$codes = $this->gen_code($this->input->post('org_type'));
		$data = array(
		'code'			=> $codes,
		'type'			=> $type,
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
		'reg_by'		=> $this->session->userdata('ref_id'),
		'reg_date'		=> date('Y-m-d h:i:s'),
		'chg_by'		=> $this->session->userdata('ref_id'),
		'chg_date'		=> date('Y-m-d h:i:s')
		);
		$this->db->insert('organization',$data);
		redirect('registration/school/confirm/'.$codes);
		}
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