<style>
.shortcut{
	border:1px solid lightgray;
}
.shortcut-label{
	font-size:9pt
}
</style>
	
	      <div class="row">
	      	
	      	<div class="span8">      		
	      		
	      	<div class="widget">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3>Organization Form</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">  
			<center>
			<img src="<?php echo base_url();?>assets/img/banner.png" style="width:300px">
			<h3 style="color:white;margin-top:-47px">Form Register</h3></center><br><br>
			<form id="edit-profile" class="form-horizontal">
									<fieldset>
										<div class="control-group">											
											<label class="control-label" for="username">Code</label>
											<div class="controls">
												<input type="text" class="span5" id="code" name="code" placeholder="Code" readonly>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="username">Type</label>
											<div class="controls">
												<select class="span5" id="type" name="type">
												<option></option>
												</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="username">Address</label>
											<div class="controls">
												<textarea class="span5" id="address" name="address" placeholder="Address"></textarea>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="username">Country</label>
											<div class="controls">
												<input type="text" class="span5" id="country" name="country" placeholder="Country" readonly style="border-radius:3px 0px 0px 3px">
												<a data-toggle="modal" href="#myModal" class="btn btn-success" style="margin-left:-3px; border-radius:0px 5px 5px 0px"><i class="icon-search"></i></a> 
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="username">Region</label>
											<div class="controls">
												<input type="text" class="span5" id="region" name="region" placeholder="Region" readonly style="border-radius:3px 0px 0px 3px">
												<a data-toggle="modal" href="#myModal" class="btn btn-success" style="margin-left:-3px; border-radius:0px 5px 5px 0px"><i class="icon-search"></i></a> 
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">											
											<label class="control-label" for="username">City</label>
											<div class="controls">
												<input type="text" class="span5" id="city" name="city" placeholder="City" readonly style="border-radius:3px 0px 0px 3px">
												<a data-toggle="modal" href="#myModal" class="btn btn-success" style="margin-left:-3px; border-radius:0px 5px 5px 0px"><i class="icon-search"></i></a> 
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">											
											<label class="control-label" for="username">Postal Code</label>
											<div class="controls">
												<input type="text" class="span5" id="postal_code" name="postal_code" placeholder="Postal Code">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="username">Phone</label>
											<div class="controls">
												<input type="text" class="span5" id="phone" name="phone" placeholder="Phone">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="username">Fax</label>
											<div class="controls">
												<input type="text" class="span5" id="fax" name="fax" placeholder="Fax">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="username">Email</label>
											<div class="controls">
												<input type="text" class="span5" id="email" name="email" placeholder="Email">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="form-actions">
											<button type="button" class="btn btn-primary">Save</button> 
											<button type="reset" class="btn">Cancel</button>
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
            </div>
            </div>
	      		
		    </div> <!-- /span8 -->
	      	<div class="span4">      		
	      		
	      	<div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Registration Shortcut</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">  
			<div class="shortcuts"> 
			<a href="<?php echo base_url();?>registration/organization" class="shortcut"><i class="shortcut-icon icon-group"></i><span class="shortcut-label">Organization</span> </a>
			<a href="<?php echo base_url();?>registration/staff" class="shortcut"><i class="shortcut-icon icon-user-md"></i><span class="shortcut-label">Staff</span> </a>
			<a href="<?php echo base_url();?>registration/student" class="shortcut"><i class="shortcut-icon icon-user"></i> <span class="shortcut-label">Student</span> </a>
			</div>
              <!-- /shortcuts -->
            </div>
            </div>
	      		
		    </div> <!-- /span8 -->
	      	
	      	
	      	
	      </div> <!-- /row -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah Data Lembaga</h4>
            </div>
            <form class ='form-horizontal' action="http://localhost/depkes/data/lembaga/save_lembaga" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="">  
					<div class="control-group" id="">
                        <label class="control-label">Kode Lembaga</label>
                        <div class="controls">
                            <input type="text" class="span3" name="kode" placeholder="Input Kode" class="form-control" value="" required/>
                        </div>
                    </div>				
                    <div class="control-group" id="">
                        <label class="control-label">Lembaga</label>
                        <div class="controls">
                            <input type="text" class="span3" name="lembaga" placeholder="Input Lembaga" class="form-control" value="" required/>
                        </div>
                    </div>
                    <div class="control-group" id="">
                        <label class="control-label">Level</label>
                        <div class="controls">
                            <label class="radio inline">
                                <input type="radio" name="level" value="1" id="pusat"/>
                                Pusat
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="level" value="2" id="dinas" />
                                Dinas Kesehatan Kabupaten
                            </label>
							<label class="radio inline">
                                <input type="radio" name="level" value="3" id="puskesmas"/>
                                Puskesmas
                            </label>
                        </div>
                    </div>
					<div class="control-group" id="kabupaten">
                        <label class="control-label">Kabupaten</label>
                        <div class="controls">
                            <select class="span3" name="kabupaten" id="kabupaten" class="form-control" value="" required>
                                <option> -- </option>
																<option value="1">Jakarta Timur</option>
								                            </select>
                        </div>
                    </div>
                    <div class="control-group" id="kelurahan">
                        <label class="control-label">Kelurahan</label>
                        <div class="controls">
                            <select class="span3" name="kelurahan" id="kelurahan" class="form-control" value="" required>
                                <option> -- </option>
																<option value="1">Palmeriam</option>
								                            </select>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                    <input type="submit" class="btn btn-primary" value="Simpan"/>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->