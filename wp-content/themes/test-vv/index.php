<?php
/**
 * Main template file.
 */
?>
<?php get_header(); ?>
<div class="container">
    <div class="row">
        
    <?php if ( have_posts() ) { ?>
        <?php if ( is_front_page()  ) { ?>
            <h1 class="page-title hidden-title"><?php //bloginfo( 'name' ); ?></h1>
        <?php } elseif ( is_search() ) { ?>
            <h1 class="page-title"><?php printf( __( 'Search results for: %s', 'Default' ), '<span>"' . get_search_query() . '"</span>' ); ?></h1>
        <?php } ?>
            
    <?php } else { ?>

        <?php get_template_part( 'content', 'not_found' ); ?>

    <?php } ?>
    </div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>