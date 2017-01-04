 <script>
 var jQuery = jQuery.noConflict();
function loadmessage(id,did){
	jQuery('#messbody').load('<?php echo $this->page->base_url();?>/get_message/'+id);
	jQuery(this).removeClass('unread');
	jQuery.post('<?php echo $this->page->base_url();?>/change_read_status/'+did,function(data){
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
                
                <li class="dropdown"><a href=""><span class="iconfa-flag"></span> Organization</a>
                	<ul>
                    	<li><a href="<?php echo base_url();?>registration/school/add">Create</a></li>
                    	<li><a href="<?php echo base_url();?>registration/school">List</a></li>
                    </ul>
                </li>
				<li class="dropdown"><a href=""><span class="iconfa-sitemap"></span> Class</a>
                	<ul>
                    	<li><a href="<?php echo base_url();?>registration/classes/add">Create</a></li>
                    	<li><a href="<?php echo base_url();?>registration/classes">List</a></li>
                    </ul>
                </li>
				<li class="dropdown"><a href=""><span class="iconfa-user"></span> Staff</a>
                	<ul>
                    	<li><a href="<?php echo base_url();?>registration/staff/add">Create</a></li>
                    	<li><a href="<?php echo base_url();?>registration/staff">List</a></li>
                    </ul>
                </li>
				<li class="dropdown"><a href=""><span class="iconfa-user"></span> Student</a>
                	<ul>
                    	<li><a href="<?php echo base_url();?>registration/student/add">Create</a></li>
                    	<li><a href="<?php echo base_url();?>registration/student">List</a></li>
                    </ul>
                </li>
				<li class="dropdown"><a href=""><span class="iconfa-user"></span> Parent</a>
                	<ul>
                    	<li><a href="<?php echo base_url();?>registration/parent/add">Create</a></li>
                    	<li><a href="<?php echo base_url();?>registration/parent">List</a></li>
                    </ul>
                </li>
				<li class="dropdown"><a href=""><span class="iconfa-user"></span> Child</a>
                	<ul>
                    	<li><a href="<?php echo base_url();?>registration/child/add">Create</a></li>
                    	<li><a href="<?php echo base_url();?>registration/child">List</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->