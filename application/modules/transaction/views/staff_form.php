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
	});
}
</script>
<?php 
function role($id){
	if($id==1){
		return 'Headmaster';
	}elseif($id==2){
		return 'Staff / Teacher';
	}
}	
?>	
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<form class="form-horizontal" method="post" id="forms">
					<input type="hidden" name="id" id="id" class="inp">
					<div class="control-group" id="">
							<label class="control-label">Organization</label>
							<div class="controls">
								<select class="input-xxlarge inp" name="organization" id="organization">
									<option value="">-- Select Organization --</option>
									<?php foreach($orgz as $row){?>
									<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>	
						<div class="control-group" id="">
							<label class="control-label">Emp Number</label>
							<div class="controls">
								<input type="text" class="input-xxlarge inp" placeholder="NIK" name="nik" id="nik">
							</div>
						</div>
						<div class="control-group" id="">
							<label class="control-label">Name</label>
							<div class="controls">
								<input type="text" class="input-xxlarge inp" placeholder="Name" name="name" id="name">
							</div>
						</div>
						<div class="control-group" id="">
							<label class="control-label">Role</label>
							<div class="controls">
								<select class="input-xxlarge inp" name="role" id="role">
									<option value="">-- Select Role --</option>
									<option value="1">Headmaster</option>
									<option value="2">Staff / Teacher</option>
								</select>
							</div>
						</div>						
					</form>
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