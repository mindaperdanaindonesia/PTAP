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
	$('#search').click(function(){
		var org_ddl = $('#org_ddl').val();
		if(org_ddl==''){
			alert('Select Organzation First!');
		}else{
			var otable = $('#dyntable').dataTable();
			$.getJSON('<?php echo base_url();?>registration/student/get_student_filter/'+org_ddl,function(data){
				otable.fnAddData(data);
			});
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
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
				
			    <?php if($this->session->userdata('level')==1){?>
				<select class="input-xlarge" id="org_ddl" style="float:left;margin-right:10px">
				<option value="">-- Select Organization --</option>
				<?php foreach($orgz as $rows){?>
				<option value="<?php echo $rows->id;?>"><?php echo $rows->name;?></option>
				<?php } ?>
				</select>
				<button type="button" class="btn btn-primary" id="search" style="margin-top:-1px"><i class="icon-search icon-white"></i>&nbsp;Show Data</button>
				<?php } ?>
               <table id="dyntable" class="table table-bordered">
               <thead>
				<tr>
					<th>No</th>
					<th>Organization</th>
					<th>NIM</th>
					<th>Student Name</th>
					<th>Mobile</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
				<tbody id="trow">
					<?php $no=1; foreach($org as $row){?>
					<tr style="font-size:9pt;background:white">
						<td><?php echo $no;?></td>
						<td><?php echo $row->schname;?></td>
						<td><?php echo $row->nim;?></td>
						<td><?php echo $row->name;?></td>
						<td><?php echo $row->mobile;?></td>
						<td><?php echo $row->email;?></td>
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
                <h4 class="modal-title">Student Form</h4>
            </div>
                <div class="modal-body" style="">  
				<form id="forms" class="form-horizontal">
					<input type="hidden" name="id" id="id" class="inp">
					<div class="control-group" id="">
                        <label class="control-label">Organization</label>
                        <div class="controls">
							<select class="span3 inp" name="org" id="org">
								<option value="">-- Select Organization --</option>
								<?php foreach($orgz as $row){?>
								<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>	
					<div class="control-group" id="" style="margin-top:10px">
                        <label class="control-label">Student Number</label>
                        <div class="controls">
							<input type="text" class="span3 inp" name="nim" id="nim" placeholder="Student Number">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:10px">
                        <label class="control-label">Student Name</label>
                        <div class="controls">
							<input type="text" class="span3 inp" name="name" id="name" placeholder="Student Name">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:10px">
                        <label class="control-label">Email</label>
                        <div class="controls">
							<input type="text" class="span3 inp" name="email" id="email" placeholder="Email">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:10px">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
							<input type="text" class="span3 inp" name="hp" id="hp" placeholder="Mobile Number">
                        </div>
                    </div>
					<div class="control-group" id="" style="margin-top:10px">
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
				</form>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default exit" data-dismiss="modal">Exit</button>
                    <input type="submit" class="btn btn-primary" value="Save"  data-dismiss="modal" id="save"/>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	