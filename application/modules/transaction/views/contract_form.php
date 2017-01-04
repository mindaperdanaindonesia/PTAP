<script type="text/javascript" src="<?php echo base_url();?>assets/js/ui.spinner.min.js"></script>
<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$("#year").spinner();
	$("#max_user").spinner();
	$("#max_pupil").spinner();
	$("#max_mess").spinner();
	$("#max_mess_mt").spinner();
	$( ".datepicker" ).datepicker({dateFormat:'yy-mm-dd'});
	$('#staff_form').hide();
	$('#parent_form').hide();
	$('#type').attr('disabled',true);
	<?php if($act=='confirm'){?>
	$('.inp').attr('readonly','true');
	<?php } ?>
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
	if($('#cont_no').val()==''){
		$('#divcode').css('display','none');
	}else{
		$('#divcode').css('display','block');
	}
	$('.exit').click(function(){
		$('.inp').val('');
		$('#year').val('<?php echo date('Y');?>');
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
function syncs(code,name,id){
	//alert(code+name);
	$('#org_code').val(code);
	$('#org_name').val(name);
	$('#org_id').val(id);
}
function removes(id){
	var a = confirm('Are You Sure?');
	if(a==true){
	$.post('<?php echo $this->page->base_url();?>/delete/'+id,function(data){
		$('#trow').html(data);
	});
	}
}

function edit(id){
	$.getJSON('<?php echo $this->page->base_url();?>/get_contract/'+id,function(data){
		var vf = data.valid_from.split(' ');
		var vt = data.valid_to.split(' ');
		$('#id').val(data.id);
		$('#cont_no').val(data.cont_no);
		$('#org').val(data.org_code);
		$('#year').val(data.year);
		$('#valid_from').val(vf[0]);
		$('#valid_to').val(vt[0]);
		$('#max_user').val(data.max_user);
		$('#max_pupil').val(data.max_pupil);
	});
}

</script>
<style>
#ui-datepicker-div{z-index:1151 !important;}
</style>
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
function org($id){
	$CI =& get_instance();
	return $CI->db->query("select name from organization where id = '$id'")->row()->name;
}
?>	
<div class="maincontentinner">
                <div class="row-fluid">
				
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<form id="form" class="form-horizontal" method="post" action="<?php echo base_url();?>transaction/contract/save">
					<input type="hidden" name="id" id="id" class="inp" value="<?php echo $data['id'];?>">
					<br><br>
					<div class="control-group" id="" style="">
                        <label class="control-label">Organization</label>
                        <div class="controls">
							<input type="hidden" name="org_code" id="org_code" class="span3 inp" style="width:420px" readonly value="<?php echo $data['org_code'];?>">
							<input type="hidden" name="org_id" id="org_id" class="span3 inp" style="width:420px" readonly value="<?php echo $data['org_id'];?>">
							<input type="text" name="org_name" id="org_name" class="span3 inp" style="width:420px" readonly value="<?php echo $data['org_name'];?>">
							
							
							
						
						
							<a href="#myModal" data-toggle="modal" class="btn btn-primary" style="margin-top:5px;margin-left:5px"><i class="icon-search icon-white"></i></a>
                        </div>
                    </div>	
					<?php if($act!='confirm'){?>
					<div class="control-group" style="margin-top:-20px" id="divcode">
					<?php }else{ ?>
					<div class="control-group" style="margin-top:-15px" id="divcode">
					<?php } ?>
                        <label class="control-label">Contract Number</label>
                        <div class="controls">
							<input type="text" class="span3 inp" name="cont_no" id="cont_no" style="width:420px" readonly value="<?php echo $data['cont_no'];?>">
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Year</label>
                        <div class="controls">
							<input type="text" id="year" name="year" class="span3 inp input-small input-spinner" style="text-align:left !important;width:433px" value="<?php echo $data['year'];?>">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Valid From</label>
                        <div class="controls">
							<input type="text" class="span3 inp datepicker" name="valid_from" id="valid_from" style="width:420px" placeholder="Valid From" value="<?php echo $data['valid_from'];?>">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Valid To</label>
                        <div class="controls">
							<input type="text" class="span3 inp datepicker" name="valid_to" id="valid_to" style="width:420px" placeholder="Valid To" value="<?php echo $data['valid_to'];?>">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Max User</label>
                        <div class="controls">
							<input type="text" class="span3 inp input-small input-spinner" name="max_user" id="max_user" style="width:433px" value="<?php echo $data['max_user'];?>">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Max Pupil</label>
                        <div class="controls">
							<input type="text" class="span3 inp input-small input-spinner" name="max_pupil" id="max_pupil" style="width:433px" value="<?php echo $data['max_pupil'];?>">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Max Message</label>
                        <div class="controls">
							<input type="text" class="span3 inp input-small input-spinner" name="max_mess" id="max_mess" style="width:433px" value="<?php echo $data['max_mess'];?>">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Max Message Monthly</label>
                        <div class="controls">
							<input type="text" class="span3 inp input-small input-spinner" name="max_mess_mt" id="max_mess_mt" style="width:433px" value="<?php echo $data['max_mess_mt'];?>">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Option</label>
                        <div class="controls">
							<table>
								<tr>
									<td style="width:150px;padding-bottom:10px;padding-top:10px"><input type="checkbox" class="inp" name="ads_free" id="ads_free" value="1" <?php if($data['ads_free']=='1'){ echo 'checked'; }?>>&nbsp;Ads Free
									<td style="width:150px;padding-bottom:10px;padding-top:10px"><input type="checkbox" class="inp" name="feat_scor" id="feat_scor" value="1" <?php if($data['feat_scor']=='1'){ echo 'checked'; }?>>&nbsp;Feat Score
								</tr>
								<tr>
									<td style="width:150px;padding-bottom:10px"><input type="checkbox" name="feat_poll" class="inp" id="feat_poll" value="1" <?php if($data['feat_poll']=='1'){ echo 'checked'; }?>>&nbsp;Feat Poll
									<td style="width:150px;padding-bottom:10px"><input type="checkbox" name="feat_schfee" class="inp" id="feat_schfee" value="1" <?php if($data['feat_sfee']=='1'){ echo 'checked'; }?>>&nbsp;Feat School Fee
								</tr>
							</table>
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
							<?php if($act=='confirm'){?>
							<a onclick="alert('Confirm Successfully!');" href="<?php echo base_url();?>transaction/contract/add" type="button" class="btn btn-primary"><i class="iconfa-ok icon-white"></i>&nbsp;&nbsp;Confirm</a>
							<a href="<?php echo base_Url();?>transaction/contract/print_pdf" type="button" class="btn btn-info" style="color:white"><i class="icon-ok icon-white"></i>&nbsp;&nbsp;Confirm & Print PDF</a>
							<?php }elseif($act=='add'){ ?>
							<button type="submit" class="btn btn-primary"><i class="iconfa-save icon-white"></i>&nbsp;&nbsp;Save</button>
							<?php } ?>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Contract Form</h4>
            </div>
                <div class="modal-body" style="">  
				<table  id="dyntable" class="table table-bordered">
				<thead>
				  <tr>
					<th>No</th>
					<th>Org Code</th>
					<th>Org Name</th>
					<th>#</th>
				  </tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($org as $row){?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $row->code;?></td>
							<td><?php echo $row->name;?></td>
							<td><button type="button" onclick="syncs('<?php echo $row->code;?>','<?php echo $row->name;?>','<?php echo $row->id;?>')" class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><i class="icon-plus icon-white"></i></button></td>
						</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
                </div> 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>