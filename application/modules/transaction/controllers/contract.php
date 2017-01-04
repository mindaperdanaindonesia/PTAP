<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Contract extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	public function index(){
		//die(md5('123456'));
		$data['subhead']= 'Transaction ';
		$data['head']   = 'Contract';
		$data['icon']	= '<span class="iconfa-edit"></span>';
		$data['cont']	= $this->db->query("select a.*,name from contract a join organization b on a.org_code = b.id")->result();
		$data['org']	= $this->db->query("select * from organization")->result();
		$this->page->view('cont_mgt_index',$data);	
	}
	
	function form($id = '', $act = 'add'){
		$data['subhead']= 'Transaction ';
		$data['head']   = 'Contract Form';
		$data['icon']	= '<span class="iconfa-edit"></span>';
		$data['act']	= $act;	
		//$data['cont']	= $this->db->query("select a.*,name from contract a join organization b on a.org_code = b.id")->result();
		if($id==''){
			$data['data'] = array(
			'id'			=> '',
			'org_id'		=> '',
			'org_code'		=> '',
			'org_name'		=> '',
			'cont_no'		=> '',
			'year'			=> date('Y'),
			'valid_from'	=> '',
			'valid_to'		=> '',
			'max_user'		=> 0,
			'max_pupil'		=> 0,
			'max_mess'		=> 0,
			'max_mess_mt'	=> 0,
			'ads_free'      => 0,
			'feat_scor'     => 0,
			'feat_poll'     => 0,
			'feat_sfee'     => 0
			);
		}else{
			$row = $this->db->query("select a.*,b.name,b.code from contract a join organization b on a.org_code = b.id where a.id = '$id'")->row();
			$data['data'] = array(
			'id'			=> $row->id,
			'org_id'		=> $row->org_code,
			'org_code'		=> $row->code,
			'org_name'		=> $row->name,
			'cont_no'		=> $row->cont_no,
			'year'			=> $row->year,
			'valid_from'	=> $row->valid_from,
			'valid_to'		=> $row->valid_to,
			'max_user'		=> $row->max_user,
			'max_pupil'		=> $row->max_pupil,
			'max_mess'		=> $row->max_mess,
			'max_mess_mt'	=> $row->max_mess_mt,
			'ads_free'      => $row->ads,
			'feat_scor'	    => $row->feat_add_score,
			'feat_poll'     => $row->feat_add_poll,
			'feat_sfee'     => $row->feat_add_sfee
			);
		}
		$data['org']	= $this->db->query("select * from organization")->result();
		$this->page->view('contract_form',$data);
	}
	
	function gen_code($code){
		$count = $this->db->query("select * from contract where cont_no like '$code%' ")->num_rows()+1;
		//$count = 1000;
		if($count<9){
			$code = $code.'0000'.$count;
		}elseif($count<99){
			$code = $code.'000'.$count;
		}elseif($count<999){
			$code = $code.'00'.$count;
		}elseif($count<9999){
			$code = $code.'0'.$count;
		}elseif($count<99999){
			$code = $code.$count;
		}
		return $code;
	}
	
	function add(){
		$this->form('','add');
	}
	
	function org($id){
	$CI =& get_instance();
	return $CI->db->query("select name from organization where id = '$id'")->row()->name;
	}
	
	function confirm($code){
		$this->form($this->db->query("select id from contract where cont_no = '$code'")->row()->id,'confirm');
	}
	
	function save(){
		if($this->input->post('id')==''){
			$cont_no = $this->gen_code(substr($this->input->post('org_code'),0,1));
		}else{
			$cont_no = $this->input->post('cont_no');
		}
		$data = array(
		'cont_no'		=> $cont_no,
		'org_code'		=> $this->input->post('org_id'),
		'year'			=> $this->input->post('year'),
		'valid_from'	=> $this->input->post('valid_from').' 00:00:00',
		'valid_to'		=> $this->input->post('valid_to')." 23:59:59",
		'max_user'		=> $this->input->post('max_user'),
		'max_pupil'		=> $this->input->post('max_pupil'),
		'max_mess'		=> $this->input->post('max_mess'),
		'max_mess_mt'	=> $this->input->post('max_mess_mt'),
		'ads'			=> $this->input->post('ads_free'),
		'feat_add_score'=> $this->input->post('feat_scor'),
		'feat_add_poll' => $this->input->post('feat_poll'),
		'feat_add_sfee'	=> $this->input->post('feat_schfee'),
		'status'		=> 0,
		'chg_by'		=> $this->session->userdata('ref_id'),
		'chg_date'		=> date('Y-m-d h:i:s')
		);	
		if($this->input->post('id')==''){
			$this->db->insert('contract',$data);
			redirect('transaction/contract/confirm/'.$cont_no);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('contract',$data);
		}
		/*$a = $this->db->query("select a.*,name from contract a join organization b on a.org_code = b.id")->result();
		$data = '';
		$no = 1;
		foreach($a as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->cont_no.'</td>
						<td>'.$this->org($row->org_code).'</td>
						<td>'.$row->year.'</td>
						<td>'.$row->valid_from.'</td>
						<td>'.$row->valid_to.'</td>
						<td>'.$row->max_user.'</td>
						<td>'.$row->max_pupil.'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
			';
		$no++; }
		echo $data;*/
	}
	
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('contract');
		$a = $this->db->query("select a.*,name from contract a join organization b on a.org_code = b.id")->result();
		$data = '';
		$no = 1;
		foreach($a as $row){
			$data .= '
					<tr style="font-size:9pt">
						<td>'.$no.'</td>
						<td>'.$row->cont_no.'</td>
						<td>'.$this->org($row->org_code).'</td>
						<td>'.$row->year.'</td>
						<td>'.$row->valid_from.'</td>
						<td>'.$row->valid_to.'</td>
						<td>'.$row->max_user.'</td>
						<td>'.$row->max_pupil.'</td>
						<td>
						<a data-toggle=\'modal\' href="#myModal" class="btn btn-primary btns" onclick=\'edit("'.$row->id.'")\'><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick=\'removes("'.$row->id.'")\'><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
			';
		$no++; }
		echo $data;
	}
	
	function get_staff($org){
		$a = $this->db->query("select * from staff where org_code = '$org'")->result();
		$data = '<option value="">-- Select Staff</option>';
		foreach($a as $row){
			$data .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		echo $data;
	}
	
	function get_parent(){
		$a = $this->db->query("select * from parent")->result();
		$data = '<option value="">-- Select Parent --</option>';
		foreach($a as $row){
			$data .= '<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		echo $data;
	}
	
	function get_parent_email($id){
		$a = $this->db->query("select email from parent where id='$id'")->row();
		echo json_encode($a);
	}
	
	function get_contract($id){
		$a = $this->db->query("select * from contract where id = '$id'")->row();
		echo json_encode($a);
	}
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */