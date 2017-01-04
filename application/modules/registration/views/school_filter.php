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