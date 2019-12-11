<?php
/*
* WP_Query: Fetch all data for Slider custom post type with WP_Query.
*/
    $args = array(
        'post_type'=>'slider',
        'order'=>'desc',
        'status' => 'publish'
    );

    // The Query
    $wp_query = new WP_Query($args);
    
    // The Loop
    if($wp_query->have_posts()): 
     	while($wp_query->have_posts()): $wp_query->the_post();

     $slider_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
    
?>
<div class="col-lg-4 col-sm-6 col-12">
    <div class="slider-wrap">
            <img alt="" src="<?php echo $slider_image; ?>">
    </div>
</div>

<?php endwhile; endwhile; wp_reset_query();?>