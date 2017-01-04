<?php if($sprofile->type==1){?>
<div class="maincontentinner" id="mainbody" style="background-image:url('<?php echo base_url();?>assets/images/icons/new/background.jpg');background-size: cover;min-height:450px">
               
               <iframe src="http://<?php echo $sprofile->url;?>" style="width:100%;height:300px;margin:0px"></iframe> 
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2016 PT Minda Perdana Indonesia</span>
                    </div>
                    <div class="footer-right">
                        <span>Parent Teacher As Partner Application</span>
                    </div>
                </div><!--footer-->
                
                
            </div><!--maincontentinner-->
<?php }else{ ?>
<div class="maincontentinner" id="mainbody" style="background-image:url('<?php echo base_url();?>assets/images/icons/new/background.jpg');background-size: cover;min-height:450px"">
               
               <?php echo $sprofile->profile;?>
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2016 PT Minda Perdana Indonesia</span>
                    </div>
                    <div class="footer-right">
                        <span>Parent Teacher As Partner Application</span>
                    </div>
                </div><!--footer-->
                
                
            </div><!--maincontentinner-->
<?php } ?>