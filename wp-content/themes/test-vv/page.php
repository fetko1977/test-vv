<?php
/**
 * The template for displaying all pages.
 */
?>
<?php get_header(); ?>

<?php
	the_post();
?>
		
<h2><?php the_title(); ?></h2>

<div class="wysiwyg_content">
	<?php the_content(); ?>
	<?php edit_post_link(); ?>
</div><!-- .page_content -->


<?php get_footer(); ?>