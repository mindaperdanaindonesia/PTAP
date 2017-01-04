<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function angka($number){
	if ($number == '') $number = 0;
	return number_format($number, 0, ',', '.');
}

function my_number_format($number){
	if ($number == '') $number = 0;
	return number_format($number, 0, ',', '.');
}

function excel_header($filename){
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$filename");
	header("Pragma: no-cache");
	header("Expires: 0");
}

function form_data($names){
	$CI =& get_instance();

	foreach ($names as $name) {
		$prefix = substr($name, 0, 3);
	
		if ($prefix == 'num') {
			$name = substr($name, 4);
			$data[$name] = str_replace('.', '', $CI->input->post($name));
		}
		else {
			$data[$name] = $CI->input->post($name);
		}
	}
	
	return $data;
}

function newline(){
	echo "<br />";
}

function options($src, $id, $ref_val, $text_field){
	$options = '';
	foreach ($src->result() as $row) {
		$opt_value	= $row->$id;
		$text_value	= $row->$text_field;
		
		if ($row->$id == $ref_val) {
			$options .= '<option value="'.$opt_value.'" selected>'.$text_value.'</option>';
		}
		else {
			$options .= '<option value="'.$opt_value.'">'.$text_value.'</option>';
		}
	}
	return $options;
}

function password($raw_password) {
	return MD5('*123#'.$raw_password);
}

function result_to_arr($datasrc, $field) {
	$return_arr = array();
	foreach ($datasrc->result() as $row) {
		$return_arr[] = $row->$field;
	}
	return $return_arr;
}

function strip_comma($text) {
	return str_replace(',', '', $text);
}

function strip_titik($text) {
	return str_replace('.', '', $text);
}

function nama_format($text) {
    $nama = explode(' ',$text);
    if(!isset($nama[1])){
        return $nama[0];
    }else{
        return $nama[0].' '.$nama[1];
    }	
}

function tab(){
	echo "\t";
}

function terbilang($n) {
	$dasar = array(1 => 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam','Tujuh', 'Delapan', 'Sembilan');
	$angka = array(1000000000, 1000000, 1000, 100, 10, 1);
	$satuan = array('Milyar', 'Juta', 'Ribu', 'Ratus', 'Puluh', '');
	$str = '';
	$i = 0;

	if ($n == 0) {
		$str = 'Nol';
	}
	else {
		while ($n != 0) {
			$count = (int)($n / $angka[$i]);
			if ($count >= 10) {
				$str .= terbilang($count).' '.$satuan[$i].' ';
			}
			else if ($count > 0 AND $count < 10) {
				$str .= $dasar[$count].' '.$satuan[$i].' ';
			}
			$n -= $angka[$i] * $count;
			$i++;
		}
		$str = preg_replace("/Satu Puluh (\w+)/i", "\\1 belas", $str);
		$str = preg_replace("/Satu (Ribu|Ratus|Puluh|belas)/i", "se\\1", $str);
	}
	return $str;
}

function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);

	return $tanggal.' '.$bulan.' '.$tahun;		 
}	

function getBulan($bln){
	switch ($bln){
		case 1: return "Januari"; break;
		case 2:	return "Februari"; break;
		case 3:	return "Maret";	break;
		case 4:	return "April";	break;
		case 5:	return "Mei"; break;
		case 6:	return "Juni"; break;
		case 7:	return "Juli"; break;
		case 8:	return "Agustus"; break;
		case 9:	return "September";	break;
		case 10: return "Oktober"; break;
		case 11: return "November";	break;
		case 12: return "Desember";	break;
	}
}

function tgl_str($date){
	$exp = explode('-',$date);
	if(count($exp) == 3) {
		$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
	}
	return $date;
}

function tgl_sql($date){
	$exp = explode('-',$date);
	if(count($exp) == 3) {
		$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
	}
	return $date;
}

function code_asset_general(){
	$CI 	=& get_instance();
	
	$query = "
		SELECT 
		MAX(id_sub) AS id_sub 
		FROM finance.asset_general
	";
	$row = $CI->db->query($query)->row_array();
	$id_sub = $row['id_sub'];
	$plus = $id_sub+1;
	
	return $plus;
}

function kode_auto_esg(){
	$CI 	=& get_instance();
	
	$query = "
		SELECT 
		MAX(id_employee_subgroup) AS kode 
		FROM employee_subgroup
	";
	$row = $CI->db->query($query)->row_array();
	$id = $row['kode'];
	$max_id = substr($id, 2,2);
	$plus = $max_id+1;
	if($plus<10){
		$kode = "ES0".$plus;
	}
	else{
		$kode = "ES".$plus;
	}	
	
	return $kode;
}

function kode_auto_benefit(){
	$CI 	=& get_instance();
	
	$query = "
		SELECT 
		MAX(id_benefit) AS kode 
		FROM benefit
	";
	$row = $CI->db->query($query)->row_array();
	$id = $row['kode'];
	$max_id = substr($id, 1,3);
	$plus = $max_id+1;
	if($plus<10){
		$kode = "B00".$plus;
	}
	else{
		$kode = "B0".$plus;
	}	
	
	return $kode;
}

function kode_auto_deduction(){
	$CI 	=& get_instance();
	
	$query = "
		SELECT 
		MAX(id_deduction) AS kode 
		FROM deduction
	";
	$row = $CI->db->query($query)->row_array();
	$id = $row['kode'];
	$max_id = substr($id, 1,3);
	$plus = $max_id+1;
	if($plus<10){
		$kode = "D00".$plus;
	}
	else{
		$kode = "D0".$plus;
	}	
	
	return $kode;
}

function auto_number(){
	$CI 	=& get_instance();			
	$reg 	= "";
	
	$CI->db->select('code');
	$CI->db->from('project_system.project_master');
	$CI->db->order_by('code', 'desc');
	$CI->db->limit(1);
	$query = $CI->db->get();
	
	if ($query->num_rows()>0) {
		$rows = $query->row();
		$row_id = $rows->code;
		$id_row = substr($row_id,8);
		$reg = $id_row+1;
		
		if (strlen($reg)==1){$reg='000'.$reg;} 
		elseif(strlen($reg)==2){$reg='00'.$reg;}
		elseif(strlen($reg)==3){$reg='0'.$reg;}
		else {$reg=$reg;}
		
		$reg=date("y").date("m").date("d").$reg;
	} 
	else{
		$reg=date("y").date("m").date("d").'0001';
	}
	return $reg;
}

function country($code){
	$CI 	=& get_instance();	
	$row = $CI->db->query("select country_name from public.country where country_code = '$code'")->row();
	return $row->country_name;
} 

function company($code){
	$CI 	=& get_instance();	
	$row = $CI->db->query("select company_name from public.company where company_code = '$code'")->row();
	return $row->company_name;
} 

function type($code){
	$CI 	=& get_instance();	
	return $row = $CI->db->query("select type_name from sales.m_customer_type where type_code = '$code'")->row()->type_name;
}

function region($code){
	$CI 	=& get_instance();	
	return $row = $CI->db->query("select region_name from public.region where region_code = '$code'")->row()->region_name;
}

function bank($code){
	$CI 	=& get_instance();	
	return $row = $CI->db->query("select bank_name from sales.m_bank_list where bank_code = '$code'")->row()->bank_name;
}

function area($code){
	$CI 	=& get_instance();	
	$row = $CI->db->query("select a.area_name,b.company_name from sales.m_sales_area a join public.company b on a.company_code = b.company_code where a.area_code = '$code'")->row();
	//return $row->company_name."  -  ".$row->area_name;
	return $row->area_name;
}

function partner($code){
	$CI 	=& get_instance();	
	$row = $CI->db->query("select * from sales.m_partner_type where code = '$code'")->row();
	return $row->code." - ".$row->description;
}

function message_transdata($type_message){
    
    if(!isset($type_message) || empty($type_message)){
        
        return false;
        
    }
    
    $CI 	=& get_instance();
    
	$row_data = $CI->db->query("select * from public.messages where message_code = '$type_message'")->row();
    
    $message_box = '<br /><br /><div class="alert alert-'. $row_data->message_type .'">
				        <button type="button" class="close" data-dismiss="alert">
						  <i class="icon-remove"></i>
						</button>
                        <p><strong>'. $row_data->message_desc .'</strong></p>
                     </div>';
                     
    return $message_box;
    
	
} 

function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = 'muni';
    $secret_iv = 'muni123';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}


if ( ! function_exists('uploadOrigin'))
{
    function uploadOrigin($path,$name_unic,$var){ 
        $CI = get_instance();
		$CI->load->library('upload');
    
        $img_data = array();
        $config['upload_path'] = $path;  
        $config['file_name'] = strtolower($name_unic);
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '3000';  
                    
        if($_FILES[$var]["size"] > 2000000){                        
                       
            $message = array('message'=>'Max File 2 MB');
            return $message;
        }          		
        
        $CI->upload->initialize($config);                                                   
        
   	    if (!$CI->upload->do_upload($var)) {
               	
           	$message =  array('message' => $CI->upload->display_errors());
            return $message;
                
        }else { 
                        
            $img_data = $CI->upload->data(); 
                        
            $CI->load->library('image_lib');
            $image_config["image_library"] = "gd2";
            $image_config["source_image"] = $img_data["full_path"];
            $image_config['create_thumb'] = FALSE;
            $image_config['maintain_ratio'] = TRUE;
            $image_config['new_image'] = $path . '/resize-'.$img_data['file_name'];
            $image_config['quality'] = "100%";
            $image_config['width'] = 231;
            $image_config['height'] = 154;
            $dim = (intval($img_data["image_width"]) / intval($img_data["image_height"])) - ($image_config['width'] / $image_config['height']);
            $image_config['master_dim'] = ($dim > 0)? "height" : "width";
                         
            $CI->image_lib->clear();
            $CI->image_lib->initialize($image_config);
            
            if(!$CI->image_lib->resize()){ //Resize image
            
                $message =  array('message' => $CI->image_lib->display_errors());
                
                return $message;
                
            }else{
                
                return $img_data['file_name'];
                
            }
            
        }   
        
    } 
}
/************************************ call JS *************************************************/
function jquery_select2(){
	return
		'<link href="'.base_url('/assets/plugins/select2/select2.css').'" rel="stylesheet" />'."\n".
		'<link href="'.base_url('/assets/plugins/select2/select2.ext.css').'" rel="stylesheet" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/select2/select2.min.js').'"></script>'."\n";
}

function bootstrap_datepicker(){
	return
		'<link href="'.base_url('/assets/plugins/bootstrap/css/bootstrap-datepicker.css').'" rel="stylesheet" />'."\n".
		'<script type="text/javascript" src="'.base_url('/assets/plugins/bootstrap/js/bootstrap-datepicker.js').'"></script>'."\n";
}

function bootstrap_tab(){
	return
		'<script type="text/javascript" src="'.base_url('/assets/plugins/bootstrap/js/bootstrap-tab.js').'"></script>'."\n";
}

function jquery_zebra_datepicker(){
	return
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/zebra_datepicker/css/zebra_datepicker.css').'" type="text/css" />'."\n".
		'<link rel="stylesheet" href="'.base_url('/assets/plugins/zebra_datepicker/css/zebra_datepicker.ext.css').'" type="text/css" />'."\n".
		'<script type="text/javascript" src="'.base_url('assets/plugins/zebra_datepicker/js/zebra_datepicker.js').'"></script>'."\n";
}



/************************************ end call JS *************************************************/


/* End of file minda_erp_helper.php */
/* Location: ./application/helpers/minda_erp_helper.php */