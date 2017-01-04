<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<?php if($this->uri->segment(3)=='add'){ ?>
<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('#urls').hide();
	$('.pg').hide();
	$('#type').change(function(){
		if($(this).val()==1){
			$('#urls').show();
			$('.pg').hide();
		}else{
			$('#urls').hide();
			$('.pg').show();
		}
	});
});
</script>		
<?php }elseif($this->uri->segment(3)=='edit'){ ?>
<?php if($data['type']==1){?>
<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('#urls').show();
	$('.pg').hide();
	$('#type').change(function(){
		if($(this).val()==1){
			$('#urls').show();
			$('.pg').hide();
		}else{
			$('#urls').hide();
			$('.pg').show();
		}
	});
});
</script>
<?php }elseif($data['type']==2){ ?>
<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('#urls').hide();
	$('.pg').show();
	$('#type').change(function(){
		if($(this).val()==1){
			$('#urls').show();
			$('.pg').hide();
		}else{
			$('#urls').hide();
			$('.pg').show();
		}
	});
});
</script>
<?php } } ?>
<script>
function valid(){
	var $ = jQuery.noConflict();
	if($('#org').val()=='' || $('#type').val()==''){
		alert('Organization Or Profile Type Cannot Be Empty!');
	}else{
		$('#forms').submit();
	}
}
</script>
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12">
						<form class="stdform" action="<?php echo $this->page->base_url();?>/save" method="post" id="forms"/>
						<input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>">
						<p>
                            <label style="">Organization</label>
                            <span class="field">
							<select class="input-xxlarge" name="org" id="org">
							<option value="" <?php if($data['id']==''){ echo 'selected'; };?>>-- Select Organization --</option>
							<?php foreach($org as $row){?>
							<option value="<?php echo $row->id;?>" <?php if($data['org_code']==$row->id){ echo 'selected'; };?>><?php echo $row->name;?></option>
							<?php } ?>
							</select>
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Profile Type</label>
                            <span class="field">
							<select class="input-xxlarge" name="type" id="type">
							<option value=""  <?php if($data['type']==''){ echo 'selected'; };?>>-- Select Profile Type --</option>
							<option value="1" <?php if($data['type']==1){ echo 'selected'; };?>>URL Link</option>
							<option value="2" <?php if($data['type']==2){ echo 'selected'; };?>>Page Content</option>
							</select>
							</span>
                        </p>
						<p style="margin-top:-20px" id="urls">
                            <label style="">URL</label>
                            <span class="field">
							<input type="text" class="input-xxlarge" id="url" name="url" value="<?php echo $data['url'];?>" style="width:520px">
							</span>
                        </p>
						<p style="margin-top:-20px" class="pg">
                            <label style="">Page Content</label>
                            <span class="field">&nbsp;</span>
                        </p>
						<div class="pg">
                           <textarea id="page_content" name="page_content" class="ckeditor">
						   <?php echo $data['profile'];?>
						   </textarea>
                        </div>
						<button type="button" class="btn btn-primary" style="margin-top:10px" onclick="valid()"><span class="iconfa-save"></span>&nbsp;&nbsp;Save</button>
						<a href="<?php $this->page->base_url();?>" class="btn btn-warning" style="margin-top:10px"><span class="iconfa-chevron-left"></span>&nbsp;&nbsp;Back</a>
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