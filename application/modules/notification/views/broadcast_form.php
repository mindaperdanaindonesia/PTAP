<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.min.js"></script>
  <script>
  var $ = jQuery.noConflict();
  $(function() {
    $( ".datepicker" ).datepicker({dateFormat:'yy-mm-dd'});
	$("#attachbutt").click(function(){
		var num = parseInt($('#num').val());
		/*$("#attach").append('<input type="file" name="date" class="" style="margin-right:3px;margin-bottom:5px;width:500px;float:left" id="attc'+num+'"/><img src="<?php echo base_url();?>assets/images/cross.png" style="width:30px;padding-top:10px" class="hvr" id="attd'+num+'" onclick="removes('+num+')"><br id="atte'+num+'">');
		num++;*/
		$("#attach").append('<div id="div'+num+'"><input type="file" name="files[]" class="" style="background:whitesmoke;margin-right:3px;margin-bottom:5px;width:94%;float:left" id="attc'+num+'"/><button type="button" class="btn btn-danger hvr" id="attachbutt" id="attd'+num+'" onclick="removes('+num+')" style="padding:10px 15px"><span class="iconfa-remove"></span></button></div>');
		num++;
		$('#num').val(num);
	});
	$('#org').change(function(){
		$.post('<?php echo base_url();?>notification/get_classz/'+$(this).val(),function(datas){
			$('#class').html(datas);
		});
	});
  });
  function removes(num){
	  $('#attc'+num).remove();
	  $('#attd'+num).remove();
	  $('#atte'+num).remove();
	  $('#div'+num).remove();
  }
  </script>
<style>
.hvr:hover{
	cursor:pointer
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<div class="maincontentinner">
				<form class="stdform" action="<?php echo base_url();?>notification/save" method="post" enctype="multipart/form-data" />
						<input type="hidden" name="id" value="<?php echo $rows['id'];?>">
						<input type="hidden" name="mess_id" value="<?php echo $rows['mess_id'];?>">
						<p>
                            <label style="text-align:left">Organization</label>
                            <span class="field">
							<select class="input-large" style="width:222px" name="org" id="org">
							<option value="" <?php if($rows['org_id']==''){ echo 'selected'; } ?>>--  Select Organization --</option>
							<?php foreach($org as $row){?>
							<option value="<?php echo $row->id;?>" <?php if($rows['org_id']==$row->id){ echo 'selected'; } ?>><?php echo $row->name;?></option>
							<?php } ?>
							</select>
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="text-align:left">Class</label>
                            <span class="field">
							<select class="input-large" style="width:222px" name="class" id="class">
							<option value="">-- Select Class --</option>
							<?php foreach($class as $row){?>
							<option value="<?php echo $row->id;?>" <?php if($rows['class_id']==$row->id){ echo 'selected'; }?>><?php echo $row->class_name;?></option>
							<?php } ?>
							</select>
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="text-align:left">Valid Date</label>
                            <span class="field">
							<input type="text" name="date_from" class="input-large datepicker" placeholder="Valid From" style="float:left" value="<?php echo substr($rows['valid_from'],0,10);?>"/>
							
							<h5 style="float:left;padding-top:9px;padding-left:10px;padding-right:10px;font-size:9pt">To</h5>
							
							<input type="text" name="date_to" class="input-large datepicker" placeholder="Valid To" value="<?php echo substr($rows['valid_to'],0,10);?>"/>
							</span>
                        </p>
                <div>
                    <textarea class="ckeditor" name="editor1">
                        <?php echo $rows['mess_body'];?>
                    </textarea>
                </div>
				
				<button type="button" class="btn btn-primary" id="attachbutt" style="margin-top:10px;margin-bottom:10px"><span class="iconfa-folder-close"></span> Attach File</button>
				<div id="attach">
					
				</div>
				
						<!--p style="margin-top:0px">
                            <label style="text-align:left">Attachment</label>
                            <span class="field" id="attach">
							<input type="file" name="date" class="" style="float:left;margin-right:10px;width:500px"/>
							<button type="button" class="btn btn-primary" style="padding:10px 15px" id="attachbutt"><span class="iconfa-plus"></span></button><br>
							
							</span>
                        </p-->
						<input type="hidden" id="num" value="0">
						<hr style="border-top:1px solid lightgray;margin-bottom:5px">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="reset" name="reset" class="btn">Reset</button>
                <!--
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2016 PT Minda Perdana Indonesia</span>
                    </div>
                    <div class="footer-right">
                        <span>Parent Teacher As Partner Application</span>
                    </div>
                </div><!--footer-->
				</form>
            </div><!--maincontentinner-->