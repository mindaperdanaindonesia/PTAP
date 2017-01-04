<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-timepicker.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-timepicker.min.js"></script>
<script>
 var $ = jQuery.noConflict();
$(document).ready(function(){
	$('.timepicker').timepicker({
		                showSeconds: true,
                showMeridian: false,
                defaultTime: false
	});
	$('#org').change(function(){
		$.post('<?php echo base_url();?>master_data/lesson_time/get_class/'+$(this).val(),function(data){
			$('#class').html(data);
		});
	});
	$('#save').click(function(){
		$.post('<?php echo $this->page->base_url();?>/save',$('#form').serialize());
		$.post('<?php echo $this->page->base_url();?>/get_city',{},function(data){
			$('#trow').html(data);
		});
		$('#id').val('');
		$('#org').val('');
		$('#class').val('');
		$('#start_time').val('');
		$('#end_time').val('');
	});
	$('.close').click(function(){
		$('#id').val('');
		$('#city_code').val('');
		$('#City_name').val('');
		$('#country').val('');
		$('#region').val('');
	});
	$('#country').change(function(){
		$.post('<?php echo $this->page->base_url();?>/get_region/'+$('#country').val(),function(data){
			$('#region').html(data);
		});
	});
	$('#city_code').keyup(function(){
		var ccl = $(this).val().length;
		if(ccl>3){
			alert('Max Length 3 Chars!');
			$(this).val('');
		}
		if($('#id').val()==''){
			$.post('<?php echo $this->page->base_url();?>/check_code/'+$('#city_code').val(),function(count){
				if(parseInt(count)>0){
					alert('City Code Is Already Used!');
					$('#city_code').val('');
				}
			});
		}
	});
});
function edit(id){
	$.getJSON('<?php echo $this->page->base_url();?>/row_city/'+id,function(data){
		$('#id').val(data.id);
		$('#city_code').val(data.city_code);
		$('#city_name').val(data.city_name);
		$('#country').val(data.country_code);
		$.post('<?php echo $this->page->base_url();?>/get_region/'+data.country_code,function(obj){
			$('#region').html(obj);
			$('#region').val(data.region_code);
		});
	});
}

function removes(id){
	var c = confirm('Are You Sure?');
	if(c==true){
		$.post('<?php echo $this->page->base_url();?>/del_region/'+id);
		$.post('<?php echo $this->page->base_url();?>/get_region',{},function(data){
			$('#trow').html(data);
		});
	}else{
		return false;
	}
}
</script>
<div class="maincontentinner" style="background-image:url('<?php echo base_url();?>assets/images/icons/new/background.jpg');background-size: cover;">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<a data-toggle="modal" href="#myModal" class="btn btn-success" style="margin-bottom:10px;color:white" id="add"><i class="icon-plus icon-white"></i> &nbsp;Add New Lesson Time</a><br><br>
					<select>
						<option>-- Select Organization --</option>
					</select>
					<select>
						<option>-- Select Class --</option>
					</select>
                <table id="dyntable" class="table table-bordered">
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                    <thead>
				<tr>
					<th>No</th>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
					<th>Saturday</th>
					<th>Sunday</th>
					<th>Action</th>
				</tr>
				<tbody id="trow">
					
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
                <h4 class="modal-title">LEsson Time Form</h4>
            </div>
                <div class="modal-body" style="">   
				<form id="form" class="form-horizontal">
					<div class="control-group" id="">
                        <label class="control-label">Organization / School</label>
                        <div class="controls">
						<input type="hidden" name="id" id="id">
                            <select class="span3" name="org" id="org" class="form-control">
							<option value="">-- Select Organization --</option>
							<?php foreach($org as $crow){?>
							<option value="<?php echo $crow->id;?>"><?php echo $crow->name;?></option>
							<?php } ?>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="">
                        <label class="control-label">Class</label>
                        <div class="controls">
                            <select class="span3" name="class" id="class" class="form-control">
							<option value="">-- Select Class --</option>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="">
                        <label class="control-label">Start Time</label>
                        <div class="controls">
                             <div class="input-append bootstrap-timepicker">
				<input type="text"  class="form-control timepicker" name="start_time" id="start_time" />
				<span class="add-on" style="height:20px !important"><i class="iconfa-time" ></i></span>
			    </div>
                        </div>
                    </div>	
					<div class="control-group" id="">
                        <label class="control-label">End Time</label>
                        <div class="controls">
                                    <div class="input-append bootstrap-timepicker" name="end_time" id="end_time">
				<input type="text"  class="form-control timepicker" />
				<span class="add-on" style="height:20px !important"><i class="iconfa-time" ></i></span>
			    </div>
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