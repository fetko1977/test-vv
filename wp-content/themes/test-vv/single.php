<?php
/**
 * Single post template file.
 */
?>
<?php get_header(); ?>
<div class="container">
    <div class="row">
	<?php
		if ( have_posts() ) {
			?>
			<div class="col-xs-12 post_detail_wrapper">
				
				<div class="col-xs-12 post_detail">
                                        
					<?php
						the_post();
					?>
					
                                    <div id="post-<?php the_ID(); ?>" <?php post_class('blog_item_detail'); ?> class="col-xs-12">
							
						<div class="col-xs-12 post_content post_content_detail">	
						    
							<?php
                                                        // Return back to post overview page. It takes the first category from the list....
                                                            $post_categories_list = get_the_category();
                                                            
                                                            foreach($post_categories_list as $category){
                                                                /*check for category having parent or not except category id=1 which is wordpress default category (Uncategorized)*/
                                                                if($category->category_parent == 0 && $category->term_id != 1){
                                                                    ?>
                                                                        <div class="col-xs-12 cz-blogpost-back-link">
                                                                            <a href="<?php echo get_category_link($category->term_id ); ?>"><i class="fa fa-angle-right"></i> Terug naar overzicht</a>
                                                                        </div>
                                                                    <?php
                                                                }
                                                                break;
                                                            }
                                                        ?>
                                                    
                                                    <div class="col-xs-12">
                                                        
                                                        <?php
                                                        // Getting the post header image...
                                                            $post_header_image = agx_get_post_meta_acf(get_the_ID(), "blog_header_image");
                                                            //var_dump($post_header_image);
                                                            
                                                            if (is_array($post_header_image)) {
                                                                $post_header_image_url = $post_header_image["url"];
                                                        ?>
                                                                <img src="<?php echo $post_header_image_url; ?>" alt="" class="cz-blogpost-banner">
                                                        <?php
                                                            }
                                                        ?>
						
							<h1 class="entry-title"><?php the_title(); ?></h1>
							
							<div class="col-xs-12  col-xs-12 wysiwyg_content entry-content">
								<?php the_content(); ?>
								<?php edit_post_link( __( 'Edit', 'AGX' ) ); ?>
							</div><!-- .entry-content -->
                                                        
                                                        <?php 
                                                            $categories_list_as_string = "";
                                                            foreach ($post_categories_list as $key => $value){
                                                                if ($key !== count($post_categories_list) - 1) {
                                                                    $categories_list_as_string .= $value->name . ", ";
                                                                } else {
                                                                    $categories_list_as_string .= " " . $value->name;
                                                                }
                                                            }
                                                        ?>
                                                        <?php
                                                            $url = get_the_permalink();
                                                            // TODO get meta tags for facebook
                                                        ?>
                                                        <div class="col-xs-12 cz-blogpost-content-footer">
                                                            <p class="cz-blogpost-dat-author">Gepost op <?php echo get_the_date(); ?>, door <?php echo get_the_author(); ?>.</p>
                                                            <p class="cz-blogpost-categories">Categorie: <?php echo $categories_list_as_string; ?></p>
                                                            <div class="col-xs-12 cz-blogpost-social-links">
                                                                <ul>
                                                                    <span>Deel </span>
                                                                    <li class="facebook">
                                                                        <a href="https://www.facebook.com/sharer/sharer.php?t=<?php echo urlencode( esc_attr( get_the_title() ) ); ?>&u=<?php echo urlencode( esc_url( get_permalink() ) ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                                                    </li>
                                                                    <li class="twitter">
                                                                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( esc_attr( get_the_title() ) ); ?>&url=<?php echo urlencode( esc_url( get_permalink() ) ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                                                    </li>
                                                                    <li class="linkedin">
                                                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( esc_url( get_permalink() ) ); ?>&title=<?php echo urlencode( esc_attr( get_the_title() ) ); ?>&summary=<?php echo urlencode( esc_attr(get_the_excerpt() ) ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
						    </div>
						</div><!-- .post_content -->
						
						<!--<div id="comments" class="post_comments">-->
							<?php //comments_template( '', true ); ?>
						<!--</div>-->
						
					</div><!-- #post-# -->
			
				</div><!-- .post_detail -->
			
			</div><!-- .post_detail_wrapper -->
			<?php
		} else {
			
			get_template_part( 'content', 'not-found' );
			
		}
	?>
    </div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>