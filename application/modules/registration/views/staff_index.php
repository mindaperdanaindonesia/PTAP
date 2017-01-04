<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('#save').click(function(){
		$.post('<?php echo $this->page->base_url();?>/save',$("#forms").serialize(),function(data){
			$('#trow').html(data);
		});
		$('.inp').val('');
	});
	$('.exit').click(function(){
		$('.inp').val('');
	});
	$('#nik').keyup(function(){
		$.post('<?php echo base_url();?>registration/staff/check_nik/'+$(this).val(),function(count){
			if(parseInt(count)>0){
				alert('Emp Number Is Already Used!');
				$('#nik').val('');
			}
		});
	});
	$('#search').click(function(){
		var org_ddl = $('#org_ddl').val();
		if(org_ddl==''){
			alert('Select Organzation First!');
		}else{
			var otable = $('#dyntable').dataTable();
			$.getJSON('<?php echo base_url();?>registration/staff/get_staff_filter/'+org_ddl,function(data){
				otable.fnAddData(data);
			});
		}
	});
});
function removes(id){
	var a = confirm('Are You Sure?');
	if(a==true){
	$.post('<?php echo $this->page->base_url();?>/delete/'+id,function(data){
		$('#trow').html(data);
	});
	}
}

function edit(id){
	$.getJSON('<?php echo $this->page->base_url();?>/get_staff/'+id,function(data){
		$('#id').val(data.id);
		$('#organization').val(data.org_code);
		$('#nik').val(data.nik);
		$('#name').val(data.name);
		$('#role').val(data.role);
		$('#phone').val(data.phone);
		$('#mobile').val(data.mobile);
		$('#email').val(data.email);
	});
}
</script>
<?php 
function role($id){
	if($id==0){
		return 'Admin';
	}elseif($id==1){
		return 'Principal';
	}elseif($id==2){
		return 'Teacher';
	}elseif($id==3){
		return 'Admin - Staff';
	}
}	

function status($id){
	if($id==1){
		return 'Active';
	}else{
		return 'Locked';
	}
}
?>	
<?php if($this->uri->segment(3)=='add'){?>
<script>
jQuery(document).ready(function(){
	jQuery('#buttonadd').trigger('click');
});
</script>
<?php } ?>
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<a  data-toggle="modal" href="#myModal" class="btn btn-success" style="margin-bottom:10px;color:white;display:none" id="buttonadd"><i class="icon-plus icon-white"></i> &nbsp;Add New Staff</a>
				<?php if($this->session->userdata('level')==1){?>
				<select class="input-xlarge" id="org_ddl" style="float:left;margin-right:10px">
				<option value="">-- Select Organization --</option>
				<?php foreach($orgz as $rows){?>
				<option value="<?php echo $rows->id;?>"><?php echo $rows->name;?></option>
				<?php } ?>
				</select>
				<button type="button" class="btn btn-primary" id="search" style="margin-top:-1px"><i class="icon-search icon-white"></i>&nbsp;Show Data</button>
				<?php } ?>
                <table id="dyntable" class="table table-bordered">
               <thead>
				<tr>
					<th>No</th>
					<th>Organization</th>
					<th>NIK</th>
					<th>Staff Name</th>
					<th>Phone</th>
					<th>Mobile</th>
					<th>Email</th>
					<th>Status</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
				<tbody id="trow">
					<?php $no=1; foreach($org as $row){?>
					<tr style="font-size:9pt;background:white">
						<td><?php echo $no;?></td>
						<td><?php echo $row->schname;?></td>
						<td><?php echo $row->nik;?></td>
						<td><?php echo $row->name;?></td>
						<td><?php echo $row->phone;?></td>
						<td><?php echo $row->mobile;?></td>
						<td><?php echo $row->email;?></td>
						<td><?php echo status($row->status);?></td>
						<td><?php echo role($row->role);?></td>
						<td>
						<a data-toggle='modal' href="#myModal" class="btn btn-primary btns" onclick="edit('<?php echo $row->id;?>')"><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick="removes('<?php echo $row->id;?>')"><i class="icon-remove icon-white"></i></button>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Staff Form</h4>
            </div>
                <div class="modal-body" style="">  
				<form class="form-horizontal" method="post" id="forms">
					<input type="hidden" name="id" id="id" class="inp">
					<div class="control-group" id="">
                        <label class="control-label">Organization</label>
                        <div class="controls">
                            <select class="input-xlarge inp" name="organization" id="organization" style="width:285px">
								<option value="" <?php if($this->session->userdata('org_id')==''){ echo 'selected'; }?> >-- Select Organization --</option>
								<?php foreach($orgz as $row){?>
								<option value="<?php echo $row->id;?>" <?php if($this->session->userdata('org_id')==$row->id){ echo 'selected'; }?> ><?php echo $row->name;?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Emp Number</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge inp" placeholder="NIK" name="nik" id="nik">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Role</label>
                        <div class="controls">
                            <select class="input-xlarge inp" name="role" id="role" style="width:285px">
								<option value="">-- Select Role --</option>
								<option value="0">Admin</option>
								<option value="1">Principal</option>
								<option value="2">Teacher</option>
								<option value="3">Admin - Staff</option>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Subject</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge inp" placeholder="Name" name="name" id="name">
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Phone</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge inp" placeholder="Phone" name="phone" id="phone">
                        </div>
                    </div>				
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Mobile</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge inp" placeholder="Mobile" name="mobile" id="mobile">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge inp" placeholder="Email" name="email" id="email">
                        </div>
                    </div>
				</form>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default exit" data-dismiss="modal">Exit</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="save">Save</button>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	