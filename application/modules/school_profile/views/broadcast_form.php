<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.min.js"></script>
  <script>
  var $ = jQuery.noConflict();
  $(function() {
    $( ".datepicker" ).datepicker({dateFormat:'yy-mm-dd'});
	$("#attachbutt").click(function(){
		var num = parseInt($('#num').val());
		$("#attach").append('<input type="file" name="date" class="" style="margin-right:3px;margin-bottom:5px;width:500px;float:left" id="attc'+num+'"/><img src="<?php echo base_url();?>assets/images/cross.png" style="width:30px;padding-top:10px" class="hvr" id="attd'+num+'" onclick="removes('+num+')"><br id="atte'+num+'">');
		num++;
		$('#num').val(num);
	});
  });
  function removes(num){
	  $('#attc'+num).remove();
	  $('#attd'+num).remove();
	  $('#atte'+num).remove();
  }
  </script>
<style>
.hvr:hover{
	cursor:pointer
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<div class="maincontentinner">
				<form class="stdform" action="<?php echo base_url();?>notification/save" method="post" />
						<p>
                            <label style="text-align:left">Class</label>
                            <span class="field">
							<select class="input-small">
							<option>--  Class --</option>
							<option value="1A">1A</option>
							</select>
							</span>
                        </p>
						<p style="margin-top:-20px">
                            <label style="text-align:left">Valid Date</label>
                            <span class="field">
							<input type="text" name="date_from" class="input-xlarge datepicker" placeholder="Valid From" style="float:left"/>
							
							<h5 style="float:left;padding-top:9px;padding-left:10px;padding-right:10px;font-size:9pt">To</h5>
							
							<input type="text" name="date_to" class="input-xlarge datepicker" placeholder="Valid To"/>
							</span>
                        </p>
                <div>
                    <textarea class="ckeditor" name="editor1">
                        
                    </textarea>
                </div>
                <br />
						<p style="margin-top:0px">
                            <label style="text-align:left">Attachment</label>
                            <span class="field" id="attach">
							<input type="file" name="date" class="" style="float:left;margin-right:10px;width:500px"/>
							<button type="button" class="btn btn-primary" style="padding:10px 15px" id="attachbutt"><span class="iconfa-plus"></span></button><br>
							
							</span>
                        </p>
						<input type="hidden" id="num" value="0">
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