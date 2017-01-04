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
	$('#formnext').css('display','none');
	$('#nextbutt').click(function(){
		if($('#org').val()==''){
		alert('Select Organization First!');	
		}else{
		$('#formnext').css('display','block');
		$('#divnext').css('display','none');
		}
	});
	<?php if($this->uri->segment(3)=='add'){?>
	$('#buttonadd').trigger('click');
	<?php } ?>
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
	$.getJSON('<?php echo $this->page->base_url();?>/get_student/'+id,function(data){
		$('#id').val(data.id);
		$('#org').val(data.org_code);
		$('#nim').val(data.nim);
		$('#name').val(data.name);
		$('#email').val(data.email);
		$('#hp').val(data.mobile);
		$('#parent').val(data.parent_id);
	});
}
</script>
<?php 
function role($id){
	if($id==1){
		return 'Kepala Sekolah';
	}elseif($id==2){
		return 'Staff';
	}
}	
?>
<style>
.input-xxlarge{
	width:420px !important
}
</style>
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<form id="forms" class="form-horizontal" action="<?php echo base_url();?>registration/student/save" method="post">
					<input type="hidden" name="id" id="id" class="inp">
					<div class="control-group" id="">
                        <label class="control-label">Organization</label>
                        <div class="controls">
							<select class="inp" name="org" id="org" style="width:433px">
								<option value="" <?php if($this->session->userdata('org_id')==''){ echo 'selected'; } ?>>-- Select Organization --</option>
								<?php foreach($orgz as $row){?>
								<option value="<?php echo $row->id;?>" <?php if($this->session->userdata('org_id')==$row->id){ echo 'selected'; } ?>><?php echo $row->name;?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="divnext" style="margin-top:-10px">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
							<button id="nextbutt" type="button" class="btn btn-primary" style="width:100px">Next</button>
                        </div>
                    </div>	
					
					<div id="formnext" >
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Student Number</label>
                        <div class="controls">
							<input type="text" class="input-xxlarge inp" name="nim" id="nim" placeholder="Student Number">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Student Name</label>
                        <div class="controls">
							<input type="text" class="input-xxlarge inp" name="name" id="name" placeholder="Student Name">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Email</label>
                        <div class="controls">
							<input type="text" class="input-xxlarge inp" name="email" id="email" placeholder="Email">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
							<input type="text" class="input-xxlarge inp" name="hp" id="hp" placeholder="Mobile Number">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">Parent</label>
                        <div class="controls">
							<select class="inp" name="parent" id="parent" style="width:433px">
								<option value="">-- Select Parent --</option>
								<?php foreach($parent as $row){?>
								<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-10px">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span>&nbsp;Save</button>
							<button type="reset" class="btn btn-info"><span class="iconfa-refresh"></span>&nbsp;Reset</button>
                        </div>
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