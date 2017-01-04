<?php 
function org($id){
	$CI =& get_instance();
	return $CI->db->query("select name from organization where id = '$id'")->row()->name;
}

function classes($id){
	$CI =& get_instance();
	return $CI->db->query("select class_name from class_master where id = '$id'")->row()->class_name;
}

function types($id){
	if($id==1){
		return 'URL Link';
	}else{
		return 'Page Content';
	}
}

function status($id){
	if($id==1){
		return 'Active';
	}else{
		return 'Inactive';
	}
}
?>		
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
                <table id="dyntable" class="table table-bordered">
                   
					<colgroup>
                        <col class="con0" style="align: center; width: 4%"/>
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
               <thead>
				<tr>
					<th>No</th>
					<th>Organization</th>
					<th>Class</th>
					<th>Valid From</th>
					<th>Valid To</th>
					<th>Created</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody id="trow">
					<?php $no=1; foreach($msg as $row){?>
					<tr style="font-size:9pt">
						<td><?php echo $no;?></td>
						<td><?php echo org($row->org_id);?></td>
						<td><?php echo classes($row->class_id);?></td>
						<td><?php echo $row->valid_from;?></td>
						<td><?php echo $row->valid_to;?></td>
						<td><?php echo $row->chg_date;?></td>
						<td><?php echo status($row->status);?></td>
						<td>
						<a data-toggle="modal" href="<?php echo $this->page->base_url();?>/edit/<?php echo $row->id;?>" class="btn btn-primary btns"><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick="removes('<?php echo $row->id;?>')"><i class="icon-remove icon-white"></i></button>
						<a href="<?php echo $this->page->base_url();?>/detail/" class="btn btn-info btns" onclick="removes('<?php echo $row->id;?>')" style="color:white">Detail</button>
						</td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>				
                    </div><!--span8-->
                    
                </div><!--row-fluid-->
                <!--
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2016 PT Minda Perdana Indonesia</span>
                    </div>
                    <div class="footer-right">
                        <span>Parent Teacher As Partner Application</span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->	