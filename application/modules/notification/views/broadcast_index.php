<script type="text/javascript">
var jQuery = jQuery.noConflict();
jQuery(document).ready(function(){
    jQuery('.msglist li').click(function(){
        jQuery('.msglist li').each(function(){ jQuery(this).removeClass('selected')});
        jQuery(this).addClass('selected');
        
        // for mobile
        jQuery('.msglist').click(function(){
            if(jQuery(window).width() < 480) {
                jQuery('.messageright, .messagemenu .back').show();
                jQuery('.messageleft').hide();
            }
        });
        
        jQuery('.messagemenu .back').click(function(){
            if(jQuery(window).width() < 480) {
                jQuery('.messageright, .messagemenu .back').hide();
                jQuery('.messageleft').show();
            }
        });
    });
});

</script>
<div class="maincontentinner">
                <div class="messagepanel">
					

                    <div class="messagemenu">
                        <ul>
                            <li style="height:40px">&nbsp;</li>
                        </ul>
                    </div>
                    <div class="messagecontent">
                        <div class="messageleft">
                            <form class="messagesearch" />
                                <input type="text" class="input-block-level" placeholder="Search message and hit enter..." />
                            </form>
                            <ul class="msglist">
								<?php foreach($msg as $row){?>
                                <li onclick="loadmessage('<?php echo $row->mess_id;?>','<?php echo $row->did;?>')" <?php if($row->read_status==0){ echo 'class="unread"'; }?> >
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb1.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small><?php echo $row->chg_date;?></small></span>
                                        <h4><?php echo $row->chg_by;?></h4>
                                        <p><strong><?php echo substr($row->mess_body,0,50);?>...</p>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div><!--messageleft-->
                        <div class="messageright">
                            <div class="messageview" style="height:600px">
                               <div id="messbody">
                                
                                </div>
								
                            </div><!--messageview-->
                            
                            <!--div class="msgreply">
                                <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb1.png" alt="" /></div>
                                <div class="reply">
                                    <textarea placeholder="Type something here to reply"></textarea>
                                </div><!--reply-->
                            <!--/div--><!--messagereply-->
                            
                        </div><!--messageright-->
                    </div><!--messagecontent-->
                </div><!--messagepanel-->
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