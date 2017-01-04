<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Catalogue_model extends CI_Model {
	
	var $table = 'catalogue.m_mat_basic';
	var $column = array('m_code','m_type','manuf','m_group');
	var $order = array('id' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
        $this->db->from($this->table);
        
		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function get_data($table) {
		return $this->db->get($table)->result();
	}
    
    /**
	 * Get Data All
	 *
	 **/ 
    public function getdata_all($table_data, $where_condition = null)
	{
		if(!isset($table_data)){
			
			return false;
            
		}
        
        if(isset($where_condition) || !empty($where_condition)){
            
            $query = $this->db->get_where($table_data, $where_condition)->result();
            
        }else{
            
            $query = $this->db->get($table_data)->result();
            
        }
		
		return $query;
	}
    
    /**
	 * Get Data Row
	 *
	 **/
    public function getdata_row($table_select, $table_data, $where_condition = array())
	{
		if(!isset($table_data)){
			
			return false;
            
		}
        
        if(!empty($table_select)){
            
            $this->db->select($table_select);
            
        }
		
        $query = $this->db->get_where($table_data, $where_condition, 1 )->row();
		
		return $query;
	}
    
    public function insert_data($table_data, $insert_data = array())
	{
		if(!isset($table_data)){
		  
			return false;
            
		}
		
        if(!is_array($insert_data)){
            
            return false;
            
        }
        
		$this->db->insert($table_data, $insert_data);
	
		return TRUE;
	}
	
	
}