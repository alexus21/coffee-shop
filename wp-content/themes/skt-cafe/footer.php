<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Cafe
 */
?> 
<div class="footerinfoarea">
	<div class="logo">
		<?php skt_cafe_the_custom_logo(); ?>
        <div class="clear"></div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <h2 class="site-title"><?php bloginfo('name'); ?></h2>
        </a>
    </div>
    <div class="clear"></div>
    <div class="footermenu">
    	<?php wp_nav_menu( array('theme_location' => 'footermenu') ); ?>
    </div>
	<?php
        $fb_link = get_theme_mod('fb_link'); 
        $twitt_link = get_theme_mod('twitt_link');
        $youtube_link = get_theme_mod('youtube_link');
        $instagram_link = get_theme_mod('instagram_link');
        $linkedin_link = get_theme_mod('linkedin_link'); 
    ?> 
    <div class="footersocial">
    	<div class="social-icons">
    	<?php 
            if (!empty($fb_link)) { ?>
            <a title="<?php echo esc_attr__('Facebook','skt-cafe'); ?>" class="fb" target="_blank" href="<?php echo esc_url($fb_link); ?>"></a> 
            <?php }  
            if (!empty($twitt_link)) { ?>
            <a title="<?php echo esc_attr__('Twitter','skt-cafe'); ?>" class="tw" target="_blank" href="<?php echo esc_url($twitt_link); ?>"></a> 
            <?php }  
            if (!empty($youtube_link)) { ?>
            <a title="<?php echo esc_attr__('Youtube','skt-cafe'); ?>" class="tube" target="_blank" href="<?php echo esc_url($youtube_link); ?>"></a> 
            <?php }   
            if (!empty($instagram_link)) { ?>
            <a title="<?php echo esc_attr__('Instagram','skt-cafe'); ?>" class="insta" target="_blank" href="<?php echo esc_url($instagram_link); ?>"></a> 
            <?php }   
            if (!empty($linkedin_link)) { ?>
            <a title="<?php echo esc_attr__('Linkedin','skt-cafe'); ?>" class="in" target="_blank" href="<?php echo esc_url($linkedin_link); ?>"></a> 
            <?php } ?>   
            </div>
    </div>
</div>
<div id="copyright-area">
<div class="copyright-wrapper">
<div class="container">
     <div class="copyright-txt"><?php bloginfo('name'); ?> <?php esc_html_e('Theme By ','skt-cafe');?> <?php if( is_home() && is_front_page() || is_home() || is_front_page()) {?>
        <a href="<?php echo esc_url('https://www.sktthemes.org/shop/free-coffeehouse-wordpress-theme/');?>" target="_blank">
        <?php esc_html_e('SKT Cafe','skt-cafe'); ?>
        </a>
        <?php } else {?>
        <?php esc_html_e('SKT Cafe','skt-cafe'); ?>
        <?php } ?></div>
     <div class="clear"></div>
</div>           
</div>
</div><!--end .footer-wrapper-->
<?php wp_footer(); ?>
</body>
</html>