<?php 
function type_org($type){
	if($type==1){
		return 'Kinder';
	}elseif($type==2){
		return 'Primary';
	}elseif($type==3){
		return 'Secondary';
	}elseif($type==4){
		return 'High School';
	}
}	
function trclass($stat){
	if($stat==0){
		return '<h5 style="padding:3px;font-size:10pt;font-weight:bold"><span style="background:yellow;border:1px solid gray">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Open</h5>';
	}elseif($stat==1){
		return '<h5 style="padding:3px;font-size:10pt;font-weight:bold"><span style="background:orange;border:1px solid gray">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Pending</h5>';
	}elseif($stat==2){
		return '<h5 style="padding:3px;font-size:10pt;font-weight:bold"><span style="background:green;border:1px solid gray">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Active</h5>';
	}elseif($stat==3){
		return '<h5 style="padding:3px;font-size:10pt;font-weight:bold"><span style="background:red;border:1px solid gray">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Locked</h5>';
	}
}
?>	
<div class="maincontentinner" style="background-image:url('<?php echo base_url();?>assets/images/icons/new/background.jpg');background-size: cover;">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<!--a href="<?php echo $this->page->base_url();?>/add" class="btn btn-success" style="margin-bottom:10px;color:white"><i class="icon-plus icon-white"></i> &nbsp;Add New School / Organization</a-->
                <table id="dyntable" class="table table-bordered">
                   
					<colgroup>
                     
                    </colgroup>
               <thead>
				<tr>
					<th>No</th>
					<th>Org Type</th>
					<th>Org Name</th>
					<th>Address</th>
					<th>City</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Contact</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody id="trow">
					<?php $no=1; foreach($org as $row){?>
					<tr style="font-size:9pt;background:white">
						<td><?php echo $no;?></td>
						<td><?php echo type_org($row->type);?></td>
						<td><?php echo $row->name;?></td>
						<td><?php echo $row->address;?></td>
						<td><?php echo city($row->city);?></td>
						<td><?php echo $row->phone;?></td>
						<td><?php echo $row->email;?></td>
						<td><?php echo $row->contact;?></td>
						<td><?php echo trclass($row->status);?></td>
						<td>
						<a href="#" class="btn btn-primary btns" ><i class="icon-edit icon-white"></i></a>
						<a href="<?php echo base_url();?>registration/school/del_org/<?php echo $row->id;?>" class="btn btn-danger btns" onclick="return confirm('Are You Sure?');"><i class="icon-remove icon-white"></i></a>
						<?Php if($row->status==0){?>
						<a href="<?php echo base_url();?>registration/school/submit_approval/<?php echo $row->id;?>" onclick="return confirm('Submit This Organizaton?')" class="btn btn-success btns" style="color:white"><i class="icon-ok icon-white"></i>&nbsp;Submit For Approval</a>
						<?php } ?>
						<?php if(($row->status==1 or $row->status==3) and ($this->session->userdata('level')==1)){?>
						<a href="<?php echo base_url();?>registration/school/activate/<?php echo $row->id;?>" onclick="return confirm('Activate This Organizaton?')" class="btn btn-info btns" style="color:white"><i class="icon-ok icon-white"></i>&nbsp;Approve</a>
						<?php } ?>
						<?php if(($row->status==2 or $row->status==1) and ($this->session->userdata('level')==1)){?>
						<a href="<?php echo base_url();?>registration/school/deactivate/<?php echo $row->id;?>" onclick="return confirm('Reject This Organizaton?')" class="btn btn-warning btns" style="color:white"><i class="iconfa-minus-sign icon-white"></i>&nbsp;Reject</a>
						<?php } ?>
						</td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>	
			<!--h5 style="padding:3px;font-size:10pt;width:200px;margin-top:10px;font-weight:bold"><span style="background:yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Open</h5>
			<h5 style="padding:3px;font-size:10pt;width:200px;font-weight:bold;margin-top:-3px"><span style="background:orange">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Pending</h5>
			<h5 style="padding:3px;font-size:10pt;width:200px;font-weight:bold;margin-top:-3px"><span style="background:green">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Active</h5>
			<h5 style="padding:3px;font-size:10pt;width:200px;font-weight:bold;margin-top:-3px"><span style="background:red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Locked</h5-->
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Country Form</h4>
            </div>
                <div class="modal-body" style="">  
				<form id="form" class="form-horizontal">
					<div class="control-group" id="">
                        <label class="control-label">Country Name</label>
                        <div class="controls">
							<input type="hidden" name="country_code" id="country_code">
                            <input type="text" class="span3" name="country_name" placeholder="Country Name" id="country_name" class="form-control" value="" required/>
                        </div>
                    </div>	
				</form>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default exit" data-dismiss="modal">Exit</button>
                    <input type="submit" class="btn btn-primary" value="Save"  data-dismiss="modal" id="save"/>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --></div>	