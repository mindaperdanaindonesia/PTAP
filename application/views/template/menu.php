
 <div class="leftpanel" style="background-color: #153739 !important;">
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

             
            <ul class="nav nav-tabs nav-stacked">
                <li class="nav-header" style="border-bottom-color: transparent; background-color: transparent; !important;"><span style="color: transparent;padding-left: 20px;">WELCOME, MINDA Logut</span></li>
                <li <?php if($this->uri->segment(1)=='dashboard'){ echo 'class="active"'; } ?>><a href="<?php echo base_url();?>dashboard" style="border-bottom-color: white !important;"><span class="iconfa-laptop"></span> Dashboard</a></li>
                <li <?php if($this->uri->segment(1)=='emagazine'){ echo 'class="active"'; } ?>><a href="<?php echo base_url();?>emagazine" style="border-bottom-color: white !important;"><span class="iconfa-rss"></span> E-Magazine</a></li>
                <li <?php if($this->uri->segment(1)=='school_profile'){ echo 'class="active"'; } ?> ><a href="<?php echo base_url();?>school_profile" style="border-bottom-color: white !important;"><span class="iconfa-leaf"></span> School Profile</a></li>
                <li <?php if($this->uri->segment(1)=='notification'){ echo 'class="active"'; } ?>><a href="<?php echo base_url();?>notification" style="border-bottom-color: white !important;"><span class="iconfa-warning-sign"></span> 
                <?php $ct = $this->db->query("select * from message_header where status = 0")->num_rows();?>
                Notification Broadcast&nbsp;&nbsp;&nbsp;<span style="padding:5px 10px;font-size:7pt;color:white;background:red;border-radius:15px"><?php echo $ct;?></span></a></li>
                <li <?php if($this->uri->segment(1)=='calendar'){ echo 'class="active"'; } ?>><a href="<?php echo base_url();?>calendar" style="border-bottom-color: white !important;"><span class="iconfa-calendar"></span> Schedule, Event & Calendar</a></li>
                <li <?php if($this->uri->segment(1)=='message'){ echo 'class="active"'; } ?>><a href="<?php echo base_url();?>registration" style="border-bottom-color: white !important;"><span class="iconfa-edit"></span> Registration</a></li>
                <?php if($this->session->userdata('level')!=4){?>
                <li <?php if($this->uri->segment(1)=='master_data'){ echo 'class="active"'; } ?>><a href="<?php echo base_url();?>master_data" style="border-bottom-color: white !important;"><span class="iconfa-folder-close"></span> Master Data</a></li>
                <?php } ?>
               <li <?php if($this->uri->segment(1)=='transaction'){ echo 'class="active"'; }?>><a href="<?php echo base_url();?>transaction" style="border-bottom-color: white !important;color:white !important"><span class="iconfa-random" style="color:white !important"></span> Transaction</a></li>
               <li <?php if($this->uri->segment(1)=='setting'){ echo 'class="active"'; }?>><a href="<?php echo base_url();?>setting" style="border-bottom-color: white !important;"><span class="iconfa-cog"></span> Setting</a></li>
            </ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->