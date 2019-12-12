<?php
/*
* Pagination
*/
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type'=>'slider',
        'order'=>'desc',
        'posts_per_page' => 8,
        'paged' => $paged
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

<?php 
		endwhile; 
	endif; 

	wp_reset_query();
?>
<div class="pagination">
    <?php
    echo paginate_links( array(
        'format'  => 'page/%#%',
        'current' => $paged,
        'total'   => $wp_query->max_num_pages,
        'mid_size'        => 2,
        'prev_text'       => __('&#10094;'),
        'next_text'       => __('&#10095;')
    ) );
    ?>
</div>