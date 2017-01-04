<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('#staff_form').hide();
	$('#parent_form').hide();
	$('#type').attr('disabled',true);
	$('#save').click(function(){
		
		var p1 = $('#pass1').val();
		var p2 = $('#pass2').val();
		if(p1!=p2){
			alert('Password Not Match!');
			return false;
		}
		$.post('<?php echo $this->page->base_url();?>/save',$("#form").serialize(),function(data){
			$('#trow').html(data);
		});
		$('.inp').val('');
	});
	$('.exit').click(function(){
		$('.inp').val('');
	});
	$('#org').change(function(){
		if($(this).val()==''){
			$('#type').attr('disabled',true);
		}else{
			$('#type').attr('disabled',false);
		}
	});
	$('#parent').change(function(){
		$.getJSON('<?php echo $this->page->base_url();?>/get_parent_email/'+$(this).val(),function(data){
			$('#email').val(data.email);
		});
	});
	$('#type').change(function(){
		var val = $(this).val();
		if(val==4){
			$('#parent_form').show();
			$('#staff_form').hide();
			$.post('<?php echo $this->page->base_url();?>/get_parent/',function(data){
				$('#parent').html(data);
			});
			$('#email').val('');
		}else{
			$('#parent_form').hide();
			$('#staff_form').show();
			$.post('<?php echo $this->page->base_url();?>/get_staff/'+$('#org').val(),function(data){
				$('#staff').html(data);
			});
			$('#email').val('');
		}
	});
	$('#pass2').blur(function(){
		var p1 = $('#pass1').val();
		var p2 = $('#pass2').val();
		if(p1!=p2){
			alert('Password Not Match!');
		}
		return false;
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
	$.getJSON('<?php echo $this->page->base_url();?>/get_account/'+id,function(data){
		alert(data.type);
		$('#id').val(data.id);
		$('#org').val(data.org_id);
		$('#type').attr('disabled',false);
		$('#type').val(data.type);
		$('#email').val(data.email);
		$('#pass1').val(data.plain_password);
		$('#pass2').val(data.plain_password);
		if(data.type==4){
			$('#parent_form').show();
			$('#staff_form').hide();
			$.post('<?php echo $this->page->base_url();?>/get_parent/',function(datas){
				$('#parent').html(datas);
				$('#parent').val(data.ref_id);
			});
		}else{
			$('#parent_form').hide();
			$('#staff_form').show();
			$.post('<?php echo $this->page->base_url();?>/get_staff/'+$('#org').val(),function(datas){
				$('#staff').html(datas);
				$('#staff').val(data.ref_id);
			});
			
		}
	});
}
</script>
<?php 
function types($id){
	if($id==1){
		return 'Superadmin';
	}elseif($id==2){
		return 'Admin';
	}elseif($id==3){
		return 'Staff';
	}elseif($id==4){
		return 'Parent';
	}
}	

function refid($type,$id){
	$CI =& get_instance();
	if($type!=4){
		return $CI->db->query("select name from staff where id = '$id'")->row()->name;
	}else{
		return $CI->db->query("select name from parent where id = '$id'")->row()->name;
	}
}

function status($id){
	if($id==1){
		return 'Active';
	}elseif($id==0){
		return 'Inactive';
	}
}

?>	
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<a href="#myModal" data-toggle="modal" class="btn btn-success" style="margin-bottom:10px;color:white"><i class="icon-plus icon-white"></i> &nbsp;Add New User</a>
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
					<th>Email</th>
					<th>User Level</th>
					<th>Name</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<tbody id="trow">
					<?php $no=1; foreach($org as $row){?>
					<tr style="font-size:9pt">
						<td><?php echo $no;?></td>
						<td><?php echo $row->email;?></td>
						<td><?php echo types($row->type);?></td>
						<td><?php echo refid($row->type,$row->ref_id);?></td>
						<td><?php echo status($row->status);?></td>
						<td>
						<a data-toggle='modal' href="#myModal" class="btn btn-primary btns" onclick='edit("<?php echo $row->id;?>")'><i class="icon-edit icon-white"></i></a>
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
                <h4 class="modal-title">Account Form</h4>
            </div>
                <div class="modal-body" style="">  
				<form id="form" class="form-horizontal">
					<input type="hidden" name="id" id="id" class="inp">
					<div class="control-group" id="" style="">
                        <label class="control-label">Organization / School</label>
                        <div class="controls">
							<select name="org" id="org" class="span3 inp">
								<option value="">-- Select Organization / School --</option>
								<?php foreach($orgz as $row){?>
								<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Account Type</label>
                        <div class="controls">
							<select name="type" id="type" class="span3 inp">
								<option value="">-- Select Account Type --</option>
								<option value="2">Admin</option>
								<option value="3">Staff</option>
								<option value="4">Parent</option>
							</select>
                        </div>
                    </div>	
					<div class="control-group" style="margin-top:-15px" id="staff_form">
                        <label class="control-label">Staff</label>
                        <div class="controls">
							<select name="staff" id="staff" class="span3 inp">
								<option value="">-- Select Staff --</option>
							</select>
                        </div>
                    </div>	
					<div class="control-group" style="margin-top:-15px" id="parent_form">
                        <label class="control-label">Parent</label>
                        <div class="controls">
							<select name="parent" id="parent" class="span3 inp">
								<option value="">-- Select Parent --</option>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Email</label>
                        <div class="controls">
							<input type="text" class="span3 inp" name="email" id="email">
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Password</label>
                        <div class="controls">
							<input type="password" class="span3 inp" name="pass1" id="pass1">
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Confirm Password</label>
                        <div class="controls">
							<input type="password" class="span3 inp" name="pass2" id="pass2">
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