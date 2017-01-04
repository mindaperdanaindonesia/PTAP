<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('#save').click(function(){
		$.post('<?php echo $this->page->base_url();?>/save',$('#form').serialize());
		$.post('<?php echo $this->page->base_url();?>/get_region',{},function(data){
			$('#trow').html(data);
		});
		$('#id').val('');
		$('#region_code').val('');
		$('#region_name').val('');
		$('#country').val('');
	});
	$('.close').click(function(){
		$('#id').val('');
		$('#region_code').val('');
		$('#region_name').val('');
		$('#country').val('');
	});
	$('#region_code').keyup(function(){
		if($('#id').val()==''){
			$.post('<?php echo $this->page->base_url();?>/check_code/'+$('#region_code').val(),function(count){
				if(parseInt(count)>0){
					alert('Region Code Is Already Used!');
					$('#region_code').val('');
				}
				var ccl = $('#region_code').val().length;
				if(ccl>3){
					alert('Max Length 3 Chars!');
					$(this).val('');
				}
			});
		}
	});
});
function edit(id){
	$.getJSON('<?php echo $this->page->base_url();?>/row_region/'+id,function(data){
		$('#id').val(data.id);
		$('#region_code').val(data.region_code);
		$('#region_name').val(data.region_name);
		$('#country').val(data.country_code);
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
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<a data-toggle="modal" href="#myModal" class="btn btn-success" style="margin-bottom:10px;color:white" id="add"><i class="icon-plus icon-white"></i> &nbsp;Add New Region</a>
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
					<th>Country</th>
					<th>Region Code</th>
					<th>Region Name</th>
					<th>Action</th>
				</tr>
				<tbody id="trow">
					<?php $no=1; foreach($org as $row){?>
					<tr style="font-size:9pt">
						<td><?php echo $no;?></td>
						<td><?php echo $row->country_name;?></td>
						<td><?php echo $row->region_code;?></td>
						<td><?php echo $row->region_name;?></td>
						<td>
						<a data-toggle="modal" href="#myModal" class="btn btn-primary btns" onclick="edit('<?php echo $row->id;?>')"><i class="icon-edit icon-white"></i></a>
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
                <h4 class="modal-title">Region Form</h4>
            </div>
                <div class="modal-body" style="">   
				<form id="form" class="form-horizontal">
					<div class="control-group" id="">
                        <label class="control-label">Country</label>
                        <div class="controls">
                            <select class="span3" name="country" id="country" class="form-control">
							<option value="">-- Select Country --</option>
							<?php foreach($country as $crow){?>
							<option value="<?php echo $crow->country_code;?>"><?php echo $crow->country_name;?></option>
							<?php } ?>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="">
                        <label class="control-label">Region Code</label>
                        <div class="controls">
                            <input type="text" class="span3" name="region_code" placeholder="Region Code" id="region_code" class="form-control" value="" required/>
                        </div>
                    </div>
					<div class="control-group" id="">
                        <label class="control-label">Region Name</label>
                        <div class="controls">
							<input type="hidden" name="id" id="id">
                            <input type="text" class="span3" name="region_name" placeholder="Region Name" id="region_name" class="form-control" value="" required/>
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