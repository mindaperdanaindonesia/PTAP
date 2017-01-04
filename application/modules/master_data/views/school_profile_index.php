<?php 
function org($id){
	$CI =& get_instance();
	return $CI->db->query("select name from organization where id = '$id'")->row()->name;
}

function types($id){
	if($id==1){
		return 'URL Link';
	}else{
		return 'Page Content';
	}
}
?>		
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<a href="<?php echo $this->page->base_url();?>/add" class="btn btn-success" style="margin-bottom:10px;color:white"><i class="icon-plus icon-white"></i> &nbsp;Add New School Profile</a>
                <table id="dyntable" class="table table-bordered">
                   
					<colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
               <thead>
				<tr>
					<th>No</th>
					<th>Organization</th>
					<th>Profile Type</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody id="trow">
					<?php $no=1; foreach($org as $row){?>
					<tr style="font-size:9pt">
						<td><?php echo $no;?></td>
						<td><?php echo org($row->org_code);?></td>
						<td><?php echo types($row->type);?></td>
						<td>
						<a href="<?php echo $this->page->base_url();?>/edit/<?php echo $row->id;?>" class="btn btn-primary btns" ><i class="icon-edit icon-white"></i></a>
						<a href="<?php echo $this->page->base_url();?>/delete/<?php echo $row->id;?>" class="btn btn-danger btns" onclick="return confirm('Are You Sure?');"><i class="icon-remove icon-white"></i></a>
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