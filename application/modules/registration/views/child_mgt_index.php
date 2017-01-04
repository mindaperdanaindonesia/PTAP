<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('#save').click(function(){
		$.post('<?php echo $this->page->base_url();?>/save',$("#form").serialize(),function(data){
			$('#trow').html(data);
		});
		$('.inp').val('');
	});
	$('.exit').click(function(){
		$('.inp').val('');
	});
	$('#org').change(function(){
		$.post('<?php echo $this->page->base_url();?>/get_student/'+$(this).val(),function(data){
			$('#child').html(data);
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
	$.getJSON('<?php echo $this->page->base_url();?>/get_childs/'+id,function(data){
		//alert(data.std_id);
		$('#parent').val(data.id);
		$('#org').val(data.org_code);
		$.post('<?php echo $this->page->base_url();?>/get_students/'+data.org_code+'/'+data.std_id,function(datas){
			$('#child').html(datas);
			$('#child').val(data.std_id);
		});
		
	});
}
</script>
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

?>	
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<a href="#myModal" data-toggle="modal" class="btn btn-success" style="margin-bottom:10px;color:white"><i class="icon-plus icon-white"></i> &nbsp;Add New Child</a>
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
					<th>Parent Name</th>
					<th>Child / Student Name</th>
					<th>School / Organization</th>
					<th>Class</th>
					<th>Action</th>
				</tr>
				<tbody id="trow">
					<?php $no=1; foreach($child as $row){?>
					<tr style="font-size:9pt">
						<td><?php echo $no;?></td>
						<td><?php echo $row->name;?></td>
						<td><?php echo $row->cname;?></td>
						<td><?php echo $row->oname;?></td>
						<td><?php echo $row->class_name;?></td>
						<td>
						<a data-toggle='modal' href="#myModal" class="btn btn-primary btns" onclick='edit("<?php echo $row->std_id;?>")'><i class="icon-edit icon-white"></i></a>
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
                <h4 class="modal-title">Child Management Form</h4>
            </div>
                <div class="modal-body" style="">  
				<form id="form" class="form-horizontal">
					<div class="control-group" id="">
						<input type="hidden" name="id" id="id" class="inp">
                        <label class="control-label">Parent</label>
                        <div class="controls">
							<select class="span3 inp" name="parent" id="parent">
								<option value="">-- Select Parent --</option>
								<?php foreach($parent as $row){?>
								<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="">
                        <label class="control-label">Organization</label>
                        <div class="controls">
							<select class="span3 inp" name="org" id="org">
								<option value="">-- Select Organization --</option>
								<?php foreach($orgs as $row){?>
								<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="">
                        <label class="control-label">Child / Student</label>
                        <div class="controls">
							<select class="span3 inp" name="child" id="child">
								<option value="">-- Select Child --</option>
							</select>
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