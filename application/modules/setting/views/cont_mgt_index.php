<script type="text/javascript" src="<?php echo base_url();?>assets/js/ui.spinner.min.js"></script>
<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$("#year").spinner();
	$( ".datepicker" ).datepicker({dateFormat:'yy-mm-dd'});
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
					<a href="#myModal" data-toggle="modal" class="btn btn-success" style="margin-bottom:10px;color:white"><i class="icon-plus icon-white"></i> &nbsp;Add New Contract</a>
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
					<th>Contract No</th>
					<th>Organization</th>
					<th>Year</th>
					<th>Valid From</th>
					<th>Valid To</th>
					<th>Max User</th>
					<th>Max Pupil</th>
					<th>Action</th>
				</tr>
				<tbody id="trow">
					<?php $no=1; foreach($cont as $row){?>
					<tr style="font-size:9pt">
						<td><?php echo $no;?></td>
						<td><?php echo $row->cont_no;?></td>
						<td><?php echo org($row->org_code);?></td>
						<td><?php echo $row->year;?></td>
						<td><?php echo $row->valid_from;?></td>
						<td><?php echo $row->valid_to;?></td>
						<td><?php echo $row->max_user;?></td>
						<td><?php echo $row->max_pupil;?></td>
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
                <h4 class="modal-title">Contract Form</h4>
            </div>
                <div class="modal-body" style="">  
				<form id="form" class="form-horizontal">
					<input type="hidden" name="id" id="id" class="inp">
					<div class="control-group" id="" style="">
                        <label class="control-label">Contract Number</label>
                        <div class="controls">
							<input type="text" class="span3 inp" name="cont_no" id="cont_no">
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Organization</label>
                        <div class="controls">
							<select name="org" id="org" class="span3 inp">
								<option value="">-- Select Organization --</option>
								<?php foreach($org as $row){?>
								<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Year</label>
                        <div class="controls">
							<input type="text" id="year" name="year" class="span3 input-small input-spinner" value="<?php echo date('Y');?>" style="text-align:left !important">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Valid From</label>
                        <div class="controls">
							<input type="text" class="span3 inp datepicker" name="valid_from" id="valid_from">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Valid To</label>
                        <div class="controls">
							<input type="text" class="span3 inp datepicker" name="valid_to" id="valid_to">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Max User</label>
                        <div class="controls">
							<input type="text" class="span3 inp" name="max_user" id="max_user">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:-15px">
                        <label class="control-label">Max Pupil</label>
                        <div class="controls">
							<input type="text" class="span3 inp" name="max_pupil" id="max_pupil">
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