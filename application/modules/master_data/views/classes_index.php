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
	$('#turnright').click(function(){
		$.post('<?php echo $this->page->base_url();?>/std_trans/',{std:$('#free_std').val(),org:$('#orgz_id').val(),cls:$('#class_id').val()},function(data){
			$('#class_member').html(data);
		});
		$.post('<?php echo $this->page->base_url();?>/get_free_student/'+$('#orgz_id').val(),function(data){
		$('#free_std').html(data);
		});
		$.post('<?php echo $this->page->base_url();?>/get_class_member/'+$('#class_id').val(),function(datas){
			$('#class_member').html(datas);
		});
	});
	$('#turnleft').click(function(){
		$.post('<?php echo $this->page->base_url();?>/std_del/',{std:$('#class_member').val(),org:$('#orgz_id').val(),cls:$('#class_id').val()},function(data){
			$('#class_member').html(data);
		});
		$.post('<?php echo $this->page->base_url();?>/get_free_student/'+$('#orgz_id').val(),function(data){
		$('#free_std').html(data);
		});
		$.post('<?php echo $this->page->base_url();?>/get_class_member/'+$('#class_id').val(),function(datas){
			$('#class_member').html(datas);
		});
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
	$.getJSON('<?php echo $this->page->base_url();?>/get_class/'+id,function(data){
		$('#id').val(data.id);
		$('#organization').val(data.org_id);
		$('#class').val(data.class_name);
	});
}

function get_member(id,org_id){
	$.post('<?php echo $this->page->base_url();?>/get_free_student/'+org_id,function(data){
		$('#free_std').html(data);
	});
	$('#class_id').val(id);
	$('#orgz_id').val(org_id);
	$.post('<?php echo $this->page->base_url();?>/get_class_member/'+id,function(data){
		$('#class_member').html(data);
	});
}
</script>
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
                                	<a  data-toggle="modal" href="#myModal" class="btn btn-success" style="margin-bottom:10px;color:white"><i class="icon-plus icon-white"></i> &nbsp;Add New Class</a>
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
										<th style="width:50%">Organization</th>
										<th>Class Name</th>
										<th>Action</th>
									</tr>
									<tbody id="trow">
										<?php $no=1; foreach($class as $row){?>
										<tr style="font-size:9pt">
											<td><?php echo $no;?></td>
											<td><?php echo $row->schname;?></td>
											<td><?php echo $row->class_name;?></td>
											<td>
											<a data-toggle='modal' href="#myModal" class="btn btn-primary btns" onclick="edit('<?php echo $row->id;?>')"><i class="icon-edit icon-white"></i></a>
											<button type="button" class="btn btn-danger btns" onclick="removes('<?php echo $row->id;?>')"><i class="icon-remove icon-white"></i></button>
											<a onclick="get_member('<?php echo $row->id;?>','<?php echo $row->org_id;?>')" data-toggle="modal" href="#manage" class="btn btn-info btns" style="color:white"><i class="icon-cog icon-white"></i> Manage Class Member</a>
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
                            <select class="span3 inp" name="organization" id="organization">
								<option value="">-- Select Organization --</option>
								<?php foreach($org as $row){?>
								<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="">
                        <label class="control-label">Class</label>
                        <div class="controls">
                            <input type="text" class="span3 inp" placeholder="Class" name="class" id="class">
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
<div class="modal fade" id="manage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Manage Class Member</h4>
            </div>
                <div class="modal-body" style="">  
				<form class="form-horizontal" method="post" id="formz">
					<center><table>
					<tr>
						<td>
						<select multiple class="span" name="free_std" id="free_std" style="height:300px;font-size:9pt">
							<option></option>
						</select>
						</td>
						<td>
						<button type="button" class="btn btn-info" style="margin:-40px 5px 0px 5px" id="turnright"><i class="iconfa-chevron-right icon-white"></i></button><br>
						<button type="button" class="btn btn-info" style="margin:-10px 5px 0px 5px" id="turnleft"><i class="iconfa-chevron-left icon-white"></i></button>
						</td>
						<td>
						<select multiple class="span" name="class_member" id="class_member"" style="height:300px;font-size:9pt">
							<option></option>
						</select>
						</td>
					</tr>
					</table></center>
					<input type="hidden" id="class_id">
					<input type="hidden" id="orgz_id">
				</form>
                </div> 
                <div class="modal-footer">
                    <!--button type="button" class="btn btn-default exit" data-dismiss="modal">Exit</button-->
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Exit</button>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->