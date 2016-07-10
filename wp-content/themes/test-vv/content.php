<?php
/**
 * The default template for displaying content when no specific content file is available
 */
?>
<?php
	// vars
	$image = default_get_post_thumbnail( get_the_ID(), 'post', 'post_thumbnail_image', 'object', true );
	if ( $image == '' ) {
		$image['alt'] = get_the_title();
		$image['src'] = get_bloginfo( 'template_url' ) . '/images/dummy_post_thumbnail_image.jpg';
	}
?>

<?php 
    $classes = array( 'col-lg-4', 'col-md-4', 'col-sm-6', 'col-xs-12');
?>
<article <?php post_class($classes); ?>>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<header>
            
	</header>
	<div class="wysiwyg_content">
		<?php 
                    the_excerpt();
                    if (get_the_content() !== "") {
                        the_content();
                    ?>
                    <a href="<?php the_permalink(); ?>"><i class="fa fa-caret-right"></i> Lees meer</a>
                <?php
                    }
                ?>
		<?php edit_post_link(); ?>
	</div>
    </div>    
</article>