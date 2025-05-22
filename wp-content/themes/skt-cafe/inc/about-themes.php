<?php
//about theme info
add_action( 'admin_menu', 'skt_cafe_abouttheme' );
function skt_cafe_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'skt-cafe'), esc_html__('About Theme', 'skt-cafe'), 'edit_theme_options', 'skt_cafe_guide', 'skt_cafe_mostrar_guide');   
} 
//guidline for about theme
function skt_cafe_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_attr_e('Theme Information', 'skt-cafe'); ?>
		   </div>
          <p><?php esc_html_e('SKT Cafe is easy, simple, flexible to use for cafe, coffee shop, restaurant, bistro, fast food, recipe, chef, kitchen, beans, tea, eat, drink, pizza delivery, bakery, cafeteria, sushi bars, barbecues, cuisine etc. Can also be used for motel, hotel, lodge, home stay and hospitality business. It is multipurpose template and comes with a ready to import Elementor template plugin as add on which allows to import 63+ design templates for making use in home and other inner pages. Use it to create any type of business, personal, blog and eCommerce website. It is fast, flexible, simple and fully customizable. WooCommerce ready designs.','skt-cafe'); ?></p>
		  <a href="<?php echo esc_url(SKT_CAFE_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(SKT_CAFE_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'skt-cafe'); ?></a> | 
				<a href="<?php echo esc_url(SKT_CAFE_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'skt-cafe'); ?></a> | 
				<a href="<?php echo esc_url(SKT_CAFE_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'skt-cafe'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_CAFE_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>