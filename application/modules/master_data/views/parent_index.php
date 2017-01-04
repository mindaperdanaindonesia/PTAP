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
	alert('tes');
	};
}
</script>
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<a  data-toggle="modal" href="#myModal" class="btn btn-success" style="margin-bottom:10px;color:white"><i class="icon-plus icon-white"></i> &nbsp;Add New Parent</a>
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
					<th>Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Action</th>
				</tr>
				<tbody id="trow">
					<?php $no=1; foreach($parent as $row){?>
					<tr style="font-size:9pt">
						<td><?php echo $no;?></td>
						<td><?php echo $row->name;?></td>
						<td><?php echo $row->email;?></td>
						<td><?php echo $row->mobile;?></td>
						<td>
						<a data-toggle='modal' href="#myModal" class="btn btn-primary btns" onclick="edit('<?php echo $row->id;?>')"><i class="icon-edit icon-white"></i></a>
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
                <h4 class="modal-title">Staff Form</h4>
            </div>
                <div class="modal-body" style="">  
				<form class="form-horizontal" method="post" id="forms">
					<input type="hidden" name="id" id="id" class="inp">
					<div class="control-group" id="">
                        <label class="control-label">Parent Name</label>
                        <div class="controls">
                            <input type="text" class="span3 inp" placeholder="Parent Name" name="name" id="name">
                        </div>
                    </div>
					<div class="control-group" id="">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input type="text" class="span3 inp" placeholder="Email" name="email" id="email">
                        </div>
                    </div>	
					<div class="control-group" id="">
                        <label class="control-label">Mobile</label>
                        <div class="controls">
                            <input type="text" class="span3 inp" placeholder="Mobile" name="hp" id="hp">
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
</div><!-- /.modal --></div>	