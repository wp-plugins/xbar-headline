<?php 
    /*
    Plugin Name: X Bar
    Plugin URI: http://www.meowp.gq/xbar
    Description: A Headline News Bar Notice! <br/> with this Xbar Headline plugin you can make your introductory text noticeable! whether your promoting your latest promo, share your discount coupons, post your important events etc. Just install and activate, add title, description and your ON! make visible and exposed with Xbar Headline! <br/> some info: use this as custom field names xbar_content_color, xbar_background,xbar_title_background,xbar_title_color and add hex value colors ex: #ffffff, #fff000 etc.  
    Author: Romeo Asis
    Version: 1.0
    Author URI: http://www.meowp.gq
    */
	
function head_line_bar_scripts() { ?>
<style>
#xbar_div h4 {
    float: left;
    padding: 0 14px;
    position: relative;
    z-index: 99999;
	height: 30px;
}
#xbar_div .marquee p {
    white-space: nowrap;
    font-size: 14px;
    padding: 4px 5px;
}
#xbar_div {
    position: fixed;
    width: 100%;
    z-index: 99999;
    height: 30px;
}
</style>

<script>
jQuery( document ).ready(function() {
var marquee = jQuery('div.marquee');
marquee.each(function() {
    var mar = jQuery(this),indent = mar.width();
    mar.marquee = function() {
        indent--;
        mar.css('text-indent',indent);
        if (indent < -1 * mar.children('div.marquee p').width()) {
            indent = mar.width();
        }
    };
    mar.data('interval',setInterval(mar.marquee,500/30));
});
});
</script>	

<?php } 

add_action('wp_head', 'head_line_bar_scripts');	
	
	
function head_line_bar_act() { ?>
<?php
    $new = new WP_Query('post_type=xbar&showposts=1');
    while ($new->have_posts()) : $new->the_post(); ?>
	
	
	<div id="xbar_div" style="color: <?php echo get_post_meta(get_the_ID(), 'xbar_content_color', true); ?>; background-color: <?php echo get_post_meta(get_the_ID(), 'xbar_background', true); ?>;">
	 <h4 style="background-color: <?php echo get_post_meta(get_the_ID(), 'xbar_title_background', true); ?>; color: <?php echo get_post_meta(get_the_ID(), 'xbar_title_color', true); ?>;"><?php the_title();?></h4><div class="marquee"><?php the_content();?></div>
	 </div>
    <?php endwhile;
	 wp_reset_query();
?>
<?php }

add_action('wp_head', 'head_line_bar_act');

// Register Custom Post Type
function Headlines() {
    $imgx = plugins_url( 'images/xbar.png', __FILE__ ); 


	$labels = array(
		'name'                => _x( 'Headlines', 'Post Type General Name', 'head_line_bar' ),
		'singular_name'       => _x( 'Headline', 'Post Type Singular Name', 'head_line_bar' ),
		'menu_name'           => __( 'Headline Bar', 'head_line_bar' ),
		'name_admin_bar'      => __( 'Headline Bar', 'head_line_bar' ),
		'parent_item_colon'   => __( 'Parent Item:', 'head_line_bar' ),
		'all_items'           => __( 'All Headline', 'head_line_bar' ),
		'add_new_item'        => __( 'Add New Headline', 'head_line_bar' ),
		'add_new'             => __( 'Add New Headline', 'head_line_bar' ),
		'new_item'            => __( 'New Headline', 'head_line_bar' ),
		'edit_item'           => __( 'Edit Headline', 'head_line_bar' ),
		'update_item'         => __( 'Update Headline', 'head_line_bar' ),
		'view_item'           => __( 'View Headline', 'head_line_bar' ),
		'search_items'        => __( 'Search Headline', 'head_line_bar' ),
		'not_found'           => __( 'Not found', 'head_line_bar' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'head_line_bar' ),
	);
	$args = array(
		'label'               => __( 'xbar', 'head_line_bar' ),
		'description'         => __( 'Adds Headline Bar Notice', 'head_line_bar' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'custom-fields' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => $imgx,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'xbar', $args );

}

// Hook into the 'init' action
add_action( 'init', 'Headlines', 0 );


	
	
	
	
	
	
	
	
?>