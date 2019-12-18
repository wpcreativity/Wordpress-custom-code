<?php
//add this code in functions.php
// Shortcode: [my_ajax_filter_search]
function my_ajax_filter_search_shortcode() {
	my_ajax_filter_search_scripts();
    ob_start(); ?>
  
    <div id="my-ajax-filter-search">
        <form action="" method="get">
            <input type="text" name="search" id="search" value="" placeholder="Search Here..">
            <div class="column-wrap">
                <div class="column">
                    <label for="year">Year</label>
                    <input type="number" name="year" id="year">
                </div>
                <div class="column">
                    <label for="rating">IMDB Rating</label>
                    <select name="rating" id="rating">
                        <option value="">Any Rating</option>
                        <option value="9">At least 9</option>
                        <option value="8">At least 8</option>
                        <option value="7">At least 7</option>
                        <option value="6">At least 6</option>
                        <option value="5">At least 5</option>
                        <option value="4">At least 4</option>
                        <option value="3">At least 3</option>
                        <option value="2">At least 2</option>
                        <option value="1">At least 1</option>
                    </select>
                </div>
            </div>
            <div class="column-wrap">
                <div class="column">
                    <label for="language">Language</label>
                    <select name="language" id="language">
                        <option value="">Any Language</option>
                        <option value="english">English</option>
                        <option value="korean">Korean</option>
                        <option value="hindi">Hindi</option>
                        <option value="serbian">Serbian</option>
                        <option value="malayalam">Malayalam</option>
                    </select>
                </div>
                <div class="column">
                    <label for="genre">Genre</label>
                    <select name="genre" id="genre">
                        <option value="">Any Genre</option>
                        <option value="action">Action</option>
                        <option value="comedy">Comedy</option>
                        <option value="drama">Drama</option>
                        <option value="horror">Horror</option>
                        <option value="romance">Romance</option>
                    </select>
                </div>
            </div>
            <input type="submit" id="submit" name="submit" value="Search">
        </form>
        <ul id="ajax_fitler_search_results"></ul>
    </div>
      
    <?php
    return ob_get_clean();
}
  
add_shortcode ('my_ajax_filter_search', 'my_ajax_filter_search_shortcode');


// Scripts for Ajax Filter Search  
function my_ajax_filter_search_scripts() {
    wp_enqueue_script( 'my_ajax_filter_search', get_stylesheet_directory_uri(). '/assets/js/ajax-script.js', array(), '1.0', true );
    wp_localize_script( 'my_ajax_filter_search', 'ajax_url', admin_url('admin-ajax.php') );
}

// Ajax Callback
add_action('wp_ajax_my_ajax_filter_search', 'my_ajax_filter_search_callback');
add_action('wp_ajax_nopriv_my_ajax_filter_search', 'my_ajax_filter_search_callback');
  
function my_ajax_filter_search_callback() {
  
    $meta_query = array('relation' => 'AND');
  
    if(isset($_GET['year'])) {
        $year = sanitize_text_field( $_GET['year'] );
        $meta_query[] = array(
            'key' => 'year',
            'value' => $year,
            'compare' => '='
        );
    }
  
    if(isset($_GET['rating'])) {
        $rating = sanitize_text_field( $_GET['rating'] );
        $meta_query[] = array(
            'key' => 'rating',
            'value' => $rating,
            'compare' => '>='
        );
    }
  
    if(isset($_GET['language'])) {
        $language = sanitize_text_field( $_GET['language'] );
        $meta_query[] = array(
            'key' => 'language',
            'value' => $language,
            'compare' => '='
        );
    }
  
    $tax_query = array();
  
    if(isset($_GET['genre'])) {
        $genre = sanitize_text_field( $_GET['genre'] );
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $genre
        );
    }
  
    $args = array(
        'post_type' => 'movies',
        'posts_per_page' => -1,
        'meta_query' => $meta_query,
        'tax_query' => $tax_query
    );
  
    if(isset($_GET['search'])) {
        $search = sanitize_text_field( $_GET['search'] );
        $search_query = new WP_Query( array(
            'post_type' => 'movies',
            'posts_per_page' => -1,
            'meta_query' => $meta_query,
            'tax_query' => $tax_query,
            's' => $search
        ) );
    } else {
        $search_query = new WP_Query( $args );
    }
  
    if ( $search_query->have_posts() ) {
  
        $result = array();
  
        while ( $search_query->have_posts() ) {
            $search_query->the_post();
  
            $cats = strip_tags( get_the_category_list(", ") );
            $result[] = array(
                "id" => get_the_ID(),
                "title" => get_the_title(),
                "content" => get_the_content(),
                "permalink" => get_permalink(),
                "year" => get_field('year'),
                "rating" => get_field('rating'),
                "director" => get_field('director'),
                "language" => get_field('language'),
                "genre" => $cats,
                "poster" => wp_get_attachment_url(get_post_thumbnail_id($post->ID),'full')
            );
        }
        wp_reset_query();
  
        echo json_encode($result);
  
    } else {
        // no posts found
    }
    wp_die();
}
?>


//add this code in js file (I created ajax-script.js)
$ = jQuery;
  
var mafs = $("#my-ajax-filter-search"); 
var mafsForm = mafs.find("form"); 
  
mafsForm.submit(function(e){
    e.preventDefault(); 
  
    if(mafsForm.find("#search").val().length !== 0) {
    var search = mafsForm.find("#search").val();
    }
    if(mafsForm.find("#year").val().length !== 0) {
        var year = mafsForm.find("#year").val();
    }
    if(mafsForm.find("#rating").val().length !== 0) {
        var rating = mafsForm.find("#rating").val();
    }
    if(mafsForm.find("#language").val().length !== 0) {
        var language = mafsForm.find("#language").val();
    }
    if(mafsForm.find("#genre").val().length !== 0) {
        var genre = mafsForm.find("#genre").val();
    }
      
    var data = {
        action : "my_ajax_filter_search",
        search : search,
        year : year,
        rating : rating,
        language : language,
        genre : genre
    }
    
    //ajax code
    $.ajax({
        url : ajax_url,
        data : data,
        success : function(response) {
            mafs.find("ul").empty();
            if(response) {
                for(var i = 0 ;  i < response.length ; i++) {
                     var html  = "<li id='movie-" + response[i].id + "'>";
                         html += "  <a href='" + response[i].permalink + "' title='" + response[i].title + "'>";
                         html += "      <img src='" + response[i].poster + "' alt='" + response[i].title + "' />";
                         html += "      <div class='movie-info'>";
                         html += "          <h4>" + response[i].title + "</h4>";
                         html += "          <p>Year: " + response[i].year + "</p>";
                         html += "          <p>Rating: " + response[i].rating + "</p>";
                         html += "          <p>Language: " + response[i].language + "</p>";
                         html += "          <p>Director: " + response[i].director + "</p>";
                         html += "          <p>Genre: " + response[i].genre + "</p>";
                         html += "      </div>";
                         html += "  </a>";
                         html += "</li>";
                     mafs.find("ul").append(html);
                }
            } else {
                var html  = "<li class='no-result'>No matching movies found. Try a different filter or search keyword</li>";
                mafs.find("ul").append(html);
            }
        } 
    });

});