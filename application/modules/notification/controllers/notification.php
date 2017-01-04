<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Notification extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->page->use_directory();
		if(!$this->session->userdata('email') and !$this->session->userdata('password') and !$this->session->userdata('name') and !$this->session->userdata('level')){
			redirect('auth');
		}
	}
	
	function uploads($data,$name){
		$file = $data;
		$folder = "./assets/upload/";
		$folder = $folder . basename($name);
		move_uploaded_file($data['tmp_name'], $folder);	
	}
	
	public function index(){
		$this->page->view('broadcast_blank');
	}
	
	public function message_list(){
		$data['subhead']= 'Notification ';
		$data['head']   = 'Broadcast';
		$data['icon']	= '<span class="iconfa-envelope"></span>';
		if($this->session->userdata('level')==4){
			$data['msg']	= $this->db->query("select b.*,a.read_status,a.id as did from message_detail a join message_header b on a.mess_id = b.mess_id join student c on c.id = a.pupil_id where c.parent_id = '".$this->session->userdata('ref_id')."'")->result();
			$this->page->view('broadcast_index',$data);	
		}else{
			$data['msg']	= $this->db->query("select * from message_header")->result();
			$this->page->view('broadcast_index_all',$data);	
		}
	}
	
	function form($id = ''){
		$data['subhead']= 'Notification';
		$data['head']   = 'Create Broadcast Message';
		$data['icon']	= '<span class="iconfa-envelope"></span>';
		$data['org']	= $this->db->query("select * from organization order by name")->result();
		if($id!=''){
			$data['rows'] = $this->db->query("select * from message_header where id = '$id'")->row_array();
			$data['class']  = $this->db->query("select * from class_master where org_id = '".$data['rows']['org_id']."'")->result();
		}else{
			$data['rows'] = array(
				'id'		=> '',
				'org_id'	=> '',
				'mess_id'	=> '',
				'class_id'	=> '',
				'valid_from'=> '',
				'valid_to'	=> '',
				'mess_body'	=> '',
				'chg_date'	=> ''
			);
			$data['class'] = array();
		}
		$this->page->view('broadcast_form',$data);
	}
	
	function add(){
		$this->form();
	}
	
	function edit($id){
		$this->form($id);
	}
	
	function save(){
		//var_dump($_FILES['files']);exit;
		if($this->input->post('id')==''){
			$mess_id		= md5(date('Ymd'));
		}else{
			$mess_id		= $this->input->post('mess_id');
		}
		
		$data = array(
		'mess_id'		=> $mess_id,
		'org_id'		=> $this->input->post('org'),
		'class_id'		=> $this->input->post('class'),
		'valid_from'	=> $this->input->post('date_from'),
		'valid_to'		=> $this->input->post('date_to')." 23:59:59",
		'status'		=> '1',
		'mess_body'		=> $this->input->post('editor1'),
		'chg_by'		=> 'Admin',
		'chg_date'		=> date('Y-m-d h:i:s')
		);
		if($this->input->post('id')==''){
			$this->db->insert('message_header',$data);
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('message_header',$data);
		}
		if($this->input->post('id')==''){
		for($no=0;$no<=sizeof($_FILES['files']['name'])-1;$no++){
			
			$folder = "./assets/upload/";
			$folder = $folder . basename($_FILES['files']['name'][$no]);
			move_uploaded_file($_FILES['files']['tmp_name'][$no], $folder);	
			$data2 = array(
			'mess_id'	=> $mess_id,
			'store'		=> $_FILES['files']['name'][$no]
			);
			
			$this->db->insert('attachment',$data2);
			
		}
		}
		$class = $this->db->query("select pupil_id from class where class_id = '".$this->input->post('class')."'")->result();
		foreach($class as $row){
			$data = array(
			'mess_id'		=> $mess_id,
			'pupil_id'		=> $row->pupil_id,
			'read_status'	=> 0,
			'chg_date'		=> date('Y-m-d')
			);
			if($this->input->post('id')==''){
			$this->db->insert('message_detail',$data);
			}
		}
		redirect('notification');
	}
	
	function get_message($id){
		$row   = $this->db->query("select * from message_header where mess_id = '$id'")->row();
		$attch = $this->db->query("select * from attachment where mess_id = '".$row->mess_id."'")->result();
		$data = '
		<div class="msgauthor">
                                    <div class="thumb"><img src="'.base_url().'assets/images/photos/thumb1.png" alt="" /></div>
                                    <div class="authorinfo">
                                        <span class="date pull-right">'.$row->chg_date.'</span>
                                        <h5><strong>Admin</strong> <span>admin@gmail.com</span></h5>
                                        <span class="to">to '.$this->session->userdata('email').'</span>
                                    </div><!--authorinfo-->
                                </div><!--msgauthor-->
                                <div class="msgbody">
                                    '.$row->mess_body.'
                                <!--msgbody-->
		';
		$data .= '<hr style="border-top:1px solid lightgray;margin-bottom:5px"><h4>Attachment</h4>';
		foreach($attch as $rows){
			$data .= '&bull;&nbsp;&nbsp;<a href="javascript:;" onclick=\'get_attach("'.base_url().'assets/upload/'.$rows->store.'")\'>'.$rows->store.'</a><br>';
		}
		$data .='</div>';
		echo $data;
	}
	
	function get_classz($id){
		$a = $this->db->query("select * from class_master where org_id = '$id'")->result();
		$data = '<option value="">-- Select Class --</option>';
		foreach($a as $row){
			$data .= '<option value="'.$row->id.'">'.$row->class_name.'</option>';
		}
		echo $data;
	}
	
	function change_read_status($id){
		$this->db->query("update message_detail set read_status = 1 where id = '$id'");
		$ct = $this->db->query("select b.*,a.read_status from message_detail a join message_header b on a.mess_id = b.mess_id join student c on c.id = a.pupil_id where c.parent_id = '".$this->session->userdata('ref_id')."' and a.read_status = 0")->num_rows();
		echo $ct;
	}
	
}

/* End of file create_customer.php */
/* Location: ./application/modules/sales/controllers/create_customer.php */