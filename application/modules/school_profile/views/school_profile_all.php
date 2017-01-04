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
<div class="maincontentinner" style="background-image:url('<?php echo base_url();?>assets/images/icons/new/background.jpg');background-size: cover;">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
				
                <table id="dyntable" class="table table-bordered">
                   
					<colgroup>
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
					<?php $no=1; foreach($sprofile as $row){?>
					<tr style="font-size:9pt;background:white">
						<td><?php echo $no;?></td>
						<td><?php echo org($row->org_code);?></td>
						<td><?php echo types($row->type);?></td>
						<td>
						<a href="<?php echo base_url();?>school_profile/shows/<?php echo $row->org_code;?>" class="btn btn-info btns" style="color:white"><i class="iconfa-globe icon-white"></i>&nbsp; Show Page</a>
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