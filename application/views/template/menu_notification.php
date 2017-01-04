 <script>
 var jQuery = jQuery.noConflict();
function loadmessage(id,did){
	jQuery('#messbody').load('<?php echo base_url();?>notification/get_message/'+id);
	jQuery(this).removeClass('unread');
	jQuery.post('<?php echo base_url();?>notification/change_read_status/'+did,function(data){
		jQuery('#not').html(data);
	});
}
 </script> 
 <div class="leftpanel">
        <div class="leftmenu">     
         <div class="pondasiakun2">MINDA HIGH SCHOOL</div>
         <div class="pondasiakun">
                <div class="akun">
                <span id="titlemenu" >&nbsp;&nbsp;&nbsp;&nbsp;parent </span> <span id="titlemenu2">teachear as </span>
                <span id="titlemenu">&nbsp;&nbsp;&nbsp;partner</span>
                </div>
                <div class="akun2">
                </div>
               </div>  
                 <div style="height: 10px;"></div>
                <div class="pondasiakun">
                <div style="height: 80px;"></div>
                <div class="welcome">
                <span id="welcometitle"> Welcome Minda,</span>
                </div>
                 <div class="welcome2">
                 <span id="logout"><a href="<?php echo base_url();?>auth/logout" style="color: white !important;">logout</a></span>
                </div>
               </div>  

                <div class="pondasiakun">
                <span style="padding-left: 50px;"><br></span>
               <span><a href="#"></a></span>
               </div>      
            <ul class="nav nav-tabs nav-stacked">
            
                <li><a href="<?php echo base_url();?>dashboard"><span class="iconfa-laptop"></span> Dashboard</a></li>
                <li class="dropdown"><a href="#"><span class="iconfa-warning-sign"></span> 
				<?php $ct = $this->db->query("select b.*,a.read_status from message_detail a join message_header b on a.mess_id = b.mess_id join student c on c.id = a.pupil_id where c.parent_id = '".$this->session->userdata('ref_id')."' and a.read_status = 0")->num_rows();?>
				Notification Broadcast
				<?php if($this->session->userdata('level')!=1){?>
				&nbsp;&nbsp;&nbsp;<span style="padding:5px 10px;font-size:7pt;color:white;background:red;border-radius:15px" id="not"><?php echo $ct;?></span>
				<?php } ?>
				</a>
					<ul>
                    	<li><a href="<?php echo base_url();?>notification/add">Create</a></li>
                    	<li><a href="<?php echo base_url();?>notification/message_list">List</a></li>
                    </ul>
				</li>
              
            </ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->