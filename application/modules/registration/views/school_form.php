<script>
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('#btnreg').hide();
	$('#btncity').hide();
	$('#save').click(function(){
		$.post('<?php echo $this->page->base_url();?>/save',$('#form').serialize());
		$.post('<?php echo $this->page->base_url();?>/get_country',{},function(data){
			$('#trow').html(data);
		});
		$('#country_code').val('');
		$('#country_name').val('');
	});
	$('.close').click(function(){
		$('#country_code').val('');
		$('#country_name').val('');
	});
	/*$('#org_type').change(function(){
		$.post('<?php echo $this->page->base_url();?>/gen_code/'+$(this).val(),function(code){
			$('#org_code').val(code);
		});
	});*/
});
function edit(id){
	$.getJSON('<?php echo $this->page->base_url();?>/row_country/'+id,function(data){
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

function setcountry(code){
	code = code.split('-');
	var $ = jQuery.noConflict();
	$('#country_code').val(code[0]);
	$('#country_name').val(code[1]);
	$('#btnreg').show();
	$('#regTable').dataTable().fnClearTable();
	$.getJSON('<?php echo $this->page->base_url();?>/get_region/'+code[0],function(data){
	$('#regTable').dataTable().fnAddData( 
	data);
	});
}
function setregion(code){
	code = code.split('-');
	var $ = jQuery.noConflict();
	$('#region_code').val(code[0]);
	$('#region_name').val(code[1]);
	$('#btncity').show();
	$('#cityTable').dataTable().fnClearTable();
	$.getJSON('<?php echo $this->page->base_url();?>/get_city/'+code[0],function(data){
	$('#cityTable').dataTable().fnAddData( 
	data);
	});
}
function setcity(code){
	code = code.split('-');
	var $ = jQuery.noConflict();
	$('#city_code').val(code[0]);
	$('#city_name').val(code[1]);
}

function valids(){
	var c = confirm('Submit This Organization?');
	if(c==true){
		$('#sfa').submit();
	}
}
</script>		
<?php if($act=='confirm'){?>
<script>
$(document).ready(function(){
$('.inp').attr('readonly',true);
});
</script>
<?php } ?>
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12">
					<?php if($act=='add'){?>
						<form class="stdform" action="<?php echo $this->page->base_url();?>/save" method="post"/>
					<?php }elseif($act=='confirm'){?>
						<form class="stdform" action="<?php echo $this->page->base_url();?>/submit_approval/<?php echo $data['id'];?>" method="post" id="sfa"/>
					<?php } ?>
						<input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>">
						<p>
                            <label style="">Organization Type</label>
                            <span class="field">
							<select class="input-xxlarge inp" name="org_type" style="width:542px" id="org_type">
							<option value="" <?php if($data['type']==''){ echo 'selected'; }?>>-- Select Organization Type --</option>
							<option value="K" <?php if($data['type']==1){ echo 'selected'; }?>>Kinder</option>
							<option value="P" <?php if($data['type']==2){ echo 'selected'; }?>>Primary</option>
							<option value="S" <?php if($data['type']==3){ echo 'selected'; }?>>Secondary</option>
							<option value="H" <?php if($data['type']==4){ echo 'selected'; }?>>High School</option>
							</select>
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Organization Code</label>
                            <span class="field">
							<input type="text" class="input-xxlarge inp" name="org_code" readonly id="org_code" value="<?php echo $data['code'];?>">
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Organization Name</label>
                            <span class="field">
							<input type="text" class="input-xxlarge inp " name="org_name" value="<?php echo $data['name'];?>">
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Address</label>
                            <span class="field">
							<textarea class="input-xxlarge inp" name="address"><?php echo $data['address'];?></textarea>
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Country</label>
                            <span class="field">
							<input type="text" class="input-xxlarge inp" id="country_name" readonly value="<?php echo $data['country_name'];?>">
							<input type="hidden" class="input-xxlarge" id="country_code" name="country_code" value="<?php echo $data['country_code'];?>">
							<?php if($act!='confirm'){?>
							<a data-toggle="modal" href="#myModal" class="btn btn-primary" style="margin-top:-5px;margin-left:5px" type="button"><span class="iconfa-search"></span></a>
							<?php } ?>
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Region</label>
                            <span class="field">
							<input type="text" class="input-xxlarge inp" id="region_name" readonly value="<?php echo $data['region_name'];?>">
							<input type="hidden" class="input-xxlarge" id="region_code" name="region_code" value="<?php echo $data['region_code'];?>">
							<a id="btnreg" data-toggle="modal" href="#regModal" class="btn btn-primary" style="margin-top:-5px;margin-left:5px" type="button"><span class="iconfa-search"></span></a>
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">City</label>
                            <span class="field">
							<input type="text" class="input-xxlarge inp" id="city_name" readonly value="<?php echo $data['city_name'];?>">
							<input type="hidden" class="input-xxlarge" id="city_code" name="city_code" value="<?php echo $data['city_code'];?>">
							<a id="btncity" data-toggle="modal" href="#cityModal" class="btn btn-primary" style="margin-top:-5px;margin-left:5px" type="button"><span class="iconfa-search"></span></a>
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Postal Code</label>
                            <span class="field">
							<input type="text" class="input-xxlarge inp" name="post_code" value="<?php echo $data['postal_code'];?>">
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Phone</label>
                            <span class="field">
							<input type="text" class="input-xxlarge inp" name="phone" value="<?php echo $data['phone'];?>">
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Fax</label>
                            <span class="field">
							<input type="text" class="input-xxlarge inp" name="fax" value="<?php echo $data['fax'];?>">
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Email</label>
                            <span class="field">
							<input type="text" class="input-xxlarge inp" name="email" value="<?php echo $data['email'];?>">
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Contact</label>
                            <span class="field">
							<input type="text" class="input-xxlarge inp" name="contact" value="<?php echo $data['contact'];?>">
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="">Organization / School Logo</label>
                            <span class="field">
							<input type="file" name="logo" class="class="input-xxlarge">
							</span>
                        </p>
						<?php if($act=='add'){ ?>
						<p>
                            <label style="">&nbsp;</label>
                            <span class="field">
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span>&nbsp;Save</button>
							<button type="button" class="btn btn-warning"><span class="icon-chevron-left icon-white"></span><span class="icon-chevron-left icon-white" style="margin-left:-5px"></span>&nbsp;Back</button>
							</span>
                        </p>
						<?php }elseif($act=='confirm'){ ?>
						<p>
                            <label style="">&nbsp;</label>
                            <span class="field">
							<button type="button" class="btn btn-primary" onclick="valids()"><span class="iconfa-ok"></span>&nbsp;Submit For Approval</button>
							</span>
                        </p>
						<?php } ?>
						</form>
                    </div><!--span8-->
                    
                </div><!--row-fluid-->
                
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2016 PT Minda Perdana Indonesia</span>
                    </div>
                    <div class="footer-right">
                        <span>Parent Teacher As Partner Application</span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
<!-- MODAL POPUP -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Country List</h4>
            </div>
                <div class="modal-body" style="">  
				<table id="dyntable" class="table table-bordered">
					<colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                <thead>
				<tr>
					<th>No</th>
					<th>Country Name</th>
					<th style="width:40px">#</th>
				</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach($country as $row){?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $row->country_name;?></td>
							<td>
							<button  data-dismiss="modal" aria-hidden="true" type="button" class="btn btn-primary" onclick="setcountry('<?php echo $row->country_code.'-'.$row->country_name;?>')"><span class="icon-plus icon-white"></span></button>
							</td>
						</tr>
					<?php $no++; } ?>
				</tbody>
				</table>
                </div> 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Region List</h4>
            </div>
                <div class="modal-body" id="region_body">  
					<table id="regTable" class="table table-bordered">
					<colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                <thead>
				<tr>
					<th>No</th>
					<th>Region Name</th>
					<th style="width:40px">#</th>
				</tr>
				</thead>
				<tbody>
				
				</tbody>
				</table>
                </div> 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="cityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Region List</h4>
            </div>
                <div class="modal-body" id="region_body">  
					<table id="cityTable" class="table table-bordered">
					<colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                <thead>
				<tr>
					<th>No</th>
					<th>City Name</th>
					<th style="width:40px">#</th>
				</tr>
				</thead>
				<tbody>
				
				</tbody>
				</table>
                </div> 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>