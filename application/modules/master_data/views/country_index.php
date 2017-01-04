<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('#save').click(function(){
		$.post('<?php echo $this->page->base_url();?>/save',$('#form').serialize());
		$.post('<?php echo $this->page->base_url();?>/get_country',{},function(data){
			$('#trow').html(data);
		});
		$('#country_code').val('');
		$('#country_name').val('');
		$('#id').val('');
	});
	$('.close').click(function(){
		$('#country_code').val('');
		$('#country_name').val('');
		$('#id').val('');
	});
	$('#country_code').keyup(function(){
		var ccl = $(this).val().length;
		if(ccl>2){
			alert('Max Length 2 Chars!');
			$(this).val('');
		}
		if($('#id').val()==''){
			$.post('<?php echo $this->page->base_url();?>/check_code/'+$('#country_code').val(),function(count){
				if(parseInt(count)>0){
					alert('Country Code Is Already Used!');
					$('#country_code').val('');
				}
			});
		}
	});
});
function edit(id){
	$.getJSON('<?php echo $this->page->base_url();?>/row_country/'+id,function(data){
		$('#id').val(data.id);
		$('#country_code').val(data.country_code);
		$('#country_name').val(data.country_name);
	});
}

function removes(id){
	var c = confirm('Are You Sure?');
	if(c==true){
		$.post('<?php echo $this->page->base_url();?>/del_country/'+id);
		$.post('<?php echo $this->page->base_url();?>/get_country',{},function(data){
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
					<a data-toggle="modal" href="#myModal" class="btn btn-success" style="margin-bottom:10px;color:white" id="add"><i class="icon-plus icon-white"></i> &nbsp;Add New Country</a>
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
					<th>Country Code</th>
					<th>Country Name</th>
					<th>Action</th>
				</tr>
				<tbody id="trow">
					<?php $no=1; foreach($org as $row){?>
					<tr style="font-size:9pt">
						<td><?php echo $no;?></td>
						<td><?php echo $row->country_code;?></td>
						<td><?php echo $row->country_name;?></td>
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
                <h4 class="modal-title">Country Form</h4>
            </div>
                <div class="modal-body" style="">  
				<form id="form" class="form-horizontal">
					<div class="control-group" id="">
                        <label class="control-label">Country Code</label>
                        <div class="controls">
							<input type="hidden" name="id" id="id">
                            <input type="text" class="span3" name="country_code" placeholder="Country Code" id="country_code" class="form-control" value="" required/>
                        </div>
                    </div>
					<div class="control-group" id="">
                        <label class="control-label">Country Name</label>
                        <div class="controls">
                            <input type="text" class="span3" name="country_name" placeholder="Country Name" id="country_name" class="form-control" value="" required/>
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