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
                    <div class="messagehead">
                        <a href="<?php echo $this->page->base_url();?>/add" class="btn btn-success btn-large" style="color:white">Compose Message</a>
                    </div><!--messagehead-->
                    <div class="messagemenu">
                        <ul>
                            <li class="back"><a><span class="iconfa-chevron-left"></span> Back</a></li>
                            <li class="active"><a href=""><span class="iconfa-inbox"></span> Inbox</a></li>
                            <li><a href=""><span class="iconfa-plane"></span> Sent</a></li>
                            <li><a href=""><span class="iconfa-edit"></span> Draft</a></li>
                            <li><a href=""><span class="iconfa-trash"></span> Trash</a></li>
                        </ul>
                    </div>
                    <div class="messagecontent">
                        <div class="messageleft">
                            <form class="messagesearch" />
                                <input type="text" class="input-block-level" placeholder="Search message and hit enter..." />
                            </form>
                            <ul class="msglist">
                                <li class="selected">
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb1.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Leevanjo Sarce</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li class="unread">
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb2.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Yanmar Iobi</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb3.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Nusjan Wanlacal</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb4.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Zaham Sindilmaca</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li class="unread">
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb5.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Weno Carasbong</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb6.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Ratesoc Maitum</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb7.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Venro Leongal</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li class="unread">
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb1.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Leevanjo Sarce</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li class="unread">
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb2.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Yanmar Iobi</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb3.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Nusjan Wanlacal</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb4.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Zaham Sindilmaca</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li class="unread">
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb5.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Weno Carasbong</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb6.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Ratesoc Maitum</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb7.png" alt="" /></div>
                                    <div class="summary">
                                        <span class="date pull-right"><small>April 03, 2013</small></span>
                                        <h4>Venro Leongal</h4>
                                        <p><strong>Lorem ipsum dol..</strong> - Hey, leevanjo doloe..</p>
                                    </div>
                                </li>
                            </ul>
                        </div><!--messageleft-->
                        <div class="messageright">
                            <div class="messageview">
                                
                                <div class="btn-group pull-right">
                                    <button data-toggle="dropdown" class="btn dropdown-toggle">Actions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Forward</a></li>
                                        <li><a href="#">Report as Spam</a></li>
                                        <li><a href="#">Delete Message</a></li>
                                        <li><a href="#">Print Message</a></li>
                                        <li><a href="#">Mark as Unread</a></li>
                                    </ul>
                                </div>
                                
                                <h1 class="subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h1>
                                <div class="msgauthor">
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb1.png" alt="" /></div>
                                    <div class="authorinfo">
                                        <span class="date pull-right">April 03, 2012</span>
                                        <h5><strong>Leevanjo Sarce</strong> <span>hisemail@hisdomain.com</span></h5>
                                        <span class="to">to me@mydomain.com</span>
                                    </div><!--authorinfo-->
                                </div><!--msgauthor-->
                                <div class="msgbody">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas</p>
                                    
                                    <p>It aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                    
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                                    <p>Regards, <br />Leevanjo</p>
                                </div><!--msgbody-->
                                
                                <div class="msgauthor">
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb10.png" alt="" /></div>
                                    <div class="authorinfo">
                                        <span class="date pull-right">April 03, 2012</span>
                                        <h5><strong>Draneim Daamul</strong> <span>myemail@mydomain.com</span></h5>
                                        <span class="to">to his@hisdomain.com</span>
                                    </div><!--authorinfo-->
                                </div><!--msgauthor-->
                                <div class="msgbody">
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas</p>
                                    
                                    <p>It aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                    <p>- Draneim</p>
                                </div><!--msgbody-->
                                
                                <div class="msgauthor">
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb1.png" alt="" /></div>
                                    <div class="authorinfo">
                                        <span class="date pull-right">April 03, 2012</span>
                                        <h5><strong>Leevanjo Sarce</strong> <span>hisemail@hisdomain.com</span></h5>
                                        <span class="to">to me@mydomain.com</span>
                                    </div><!--authorinfo-->
                                </div><!--msgauthor-->
                                <div class="msgbody">
                                    <p>It aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                </div><!--msgbody-->
                                
                                <div class="msgauthor">
                                    <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb10.png" alt="" /></div>
                                    <div class="authorinfo">
                                        <span class="date pull-right">April 03, 2012</span>
                                        <h5><strong>Draneim Daamul</strong> <span>myemail@mydomain.com</span></h5>
                                        <span class="to">to his@hisdomain.com</span>
                                    </div><!--authorinfo-->
                                </div><!--msgauthor-->
                                <div class="msgbody">                                    
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>
                                </div><!--msgbody-->
                            </div><!--messageview-->
                            
                            <div class="msgreply">
                                <div class="thumb"><img src="<?php echo base_url();?>assets/images/photos/thumb1.png" alt="" /></div>
                                <div class="reply">
                                    <textarea placeholder="Type something here to reply"></textarea>
                                </div><!--reply-->
                            </div><!--messagereply-->
                            
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