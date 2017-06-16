<li><input type="checkbox" name="sunday" <?php if( $meta_sunday == true ) { ?>checked="checked"<?php } ?>" /> Sunday<br /></li>

If( isset($_POST['sunday']) ){
    update_post_meta($post->ID, "sunday", $_POST["sunday"] );
}else{
    delete_post_meta($post->ID, "sunday");
}
return $post;
