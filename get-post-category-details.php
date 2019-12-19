<?php
/*
* get_terms: Retrieve the terms in a given taxonomy or list of taxonomies.
*/


$cats = get_terms('category');
foreach ( $cats as $product_category ) {

     $trm_name = $product_category->name;
     $trm_id   = $product_category->term_id;
     $trm_slug = $product_category->slug;
     $taxonomy = $product_category->taxonomy;

     $img = get_field('cat_image', $taxonomy .'_'. $trm_id ); //get advanced custom field vale of image field.
 
?>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="Productcard">
           <a href="category/<?php echo $trm_slug; ?>">
            <figure><img src="<?php echo $img; ?>" class="img-responsive"></figure>
            <h4><?php echo $trm_name; ?></h4>
          </a>
        </div>
    </div>

<?php } ?>



<!-- get category post in archive.php -->
<section>
    <div class="ProductArea">
        <div class="container">
            <div class="row">
                
                
            <?php
                 $queried_object = get_queried_object();
                 $trmId   = $queried_object->term_id;
                 $trmname = $queried_object->name;
                 $Slug    = $queried_object->slug;
                 $taxo    = $queried_object->taxonomy;
            ?>
        
        <?php
        $args = array(
            'post_type'=>'post',
            'tax_query' => array(
                'taxonomy' => $taxo,
                'field' => 'slug',
                'terms' => $Slug       
                )
        );
        
        ?>
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="Title"><?php echo $trmname; ?></h3>
                </div>
                
                 <?php 

                     $wp_query = new WP_Query($args);
                
                     if($wp_query->have_posts()): while($wp_query->have_posts()): $wp_query->the_post();
                     $product_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
                     
                     ?>
                
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="Productcard">
                       <a href="<?php the_permalink(); ?>">
                        <figure><img src="<?php echo $product_image[0]; ?>" class="img-responsive" style="margin: 0 auto;"></figure>
                        <h4><?php the_title(); ?></h4>
                      </a>
                    </div>
                </div>
                
                <?php endwhile; endif; wp_reset_query(); ?>
                
            </div>
        </div>
    </div>
</section>


