<footer class="container">
    <div class="page" style="margin-bottom:1px;">
        <ul class="inline-yo" style="float:left;">
            <?php
            	if( !$this->aauth->is_loggedin() )
        		{
        			echo 
        			'<li><a href="'.base_url().'login/">Login</a></li> | 
        			<li><a href="'.base_url().'register/">Register</a></li> |';
        		}else{
        			echo 
        			'<li><a href="'.base_url().'logout/" style="color:red;" onclick="return confirm(\'Are you sure you wish to logout?\')">Logout</a></li> |
        			<li><a href="'.base_url().'account/">Your account</a></li> | ';
        		}
            ?>
            <li><a href="<?php echo base_url(); ?>api/">API</a></li> | 
            <li><a href="<?php echo base_url(); ?>profiles/">Profiles listing</a></li> |
            <li><a href="<?php echo base_url(); ?>contact/">Contact</a></li>
        </ul>
        <span style="float:right;">&copy; <a href="http://joel-murphy.com/">Joel Murphy</a> <?php echo Date('Y'); ?></span>
        <div class="clearfix"></div>
    </div>
</footer>