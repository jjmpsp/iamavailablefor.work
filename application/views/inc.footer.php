<footer class="container">
    <div class="uk-container uk-container-center">
        <div class="uk-grid">
            <div class="uk-width-12">
                <div class="page">
                    <ul id="footer-menu">
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
                        <li><a href="http://iamavailablefor.work/api/">API</a></li> <span class="separator">|</span>   
                        <li><a href="http://iamavailablefor.work/profiles/">Profiles listing</a></li> <span class="separator">|</span>   
                        <li><a href="http://iamavailablefor.work/contact/">Contact</a></li>
                    </ul>
                    <span id="footer-credits">&copy; <a href="http://joel-murphy.com/">Joel Murphy</a> <?php echo Date('Y'); ?></span>
                    <div class="uk-clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</footer>