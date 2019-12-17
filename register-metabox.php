<?php 
/*
* Create Post Meta Box
* We are crating a post_meta_box for movies custom post type and in which we are showing Movie Category and Movie Type field by add_meta_box function.
*/

//Use this code in functions.php file

function my_custom_metabox_movies(){
        add_meta_box('movies-id', 'Movie Details', 'meta_box_movies', 'movies', 'side', 'high');
}

add_action('add_meta_boxes', 'my_custom_metabox_movies');

function meta_box_movies($post){ ?>
                <p>
                        <label>Movie Category:</label><br>
                        <?php $category = get_post_meta($post->ID, 'movies_category', true) ?>
                        <input type="text" value="<?php echo $category; ?>" name="movieCat">
                </p>
                <p>
                        <label>Movie Type:</label><br>
                        <?php $type = get_post_meta($post->ID, 'movies_type', true); ?>
                        <input type="text" value="<?php echo $type; ?>" name="movieType">
                </p>            
<?php }

function save_meta_box_values($post_id, $post){

        $movieCat  = isset($_POST['movieCat'])?$_POST['movieCat']:"";
        $movieType = isset($_POST['movieType'])?$_POST['movieType']:"";

        update_post_meta($post_id, "movies_category", $movieCat);
        update_post_meta($post_id, "movies_type", $movieType);

}

add_action('save_post', 'save_meta_box_values', 10, 2);


//Use this code in functions.php file
?>
<div id="primary" class="content-area">
        <main id="main" class="site-main">
                <section class="movies-data">

                <?php
                        $productArys = array(
                            'post_type'=>'movies',
                            'order'=>'ASC'
                            );
                            
                        $productQuery= new WP_Query($productArys);

                        while($productQuery->have_posts()): $productQuery->the_post();
                        $product_image = wp_get_attachment_url(get_post_thumbnail_id($result->ID));
                ?>


        <div class="container">
                <div class="row">
                        <div class="col-md-12">
                                <h4><?php the_title();?></h4>
                                <p><?php the_content();?></p>
                                <?php 
                                        $moviecat = get_post_meta($post->ID, "movies_category", true);
                                        $movietype = get_post_meta($post->ID, "movies_type", true);
                                ?>
                                <p>Movie Category: <?php echo $moviecat; ?></p>
                                <p>Movie Type: <?php echo $movietype; ?></p>

                        </div>
                </div>
        </div>

        <?php
                        endwhile;
        wp_reset_query();
        ?>
                </section>
        </main>
</div>