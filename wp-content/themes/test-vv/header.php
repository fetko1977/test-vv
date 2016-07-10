<?php
/**
 * Header
 */
 	session_start();
	
 	global $theme_options;
	$theme_options = get_option( 'default_theme_options' );
	
	// scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'modernizr_script', get_bloginfo( 'template_url' ) . '/javascript/vendor/modernizr.js' );
        wp_enqueue_script( 'image_is_loaded', get_bloginfo( 'template_url' ) . '/javascript/vendor/imagesloaded.pkgd.min.js' );
	wp_enqueue_script( 'fastclick_script', get_bloginfo( 'template_url' ) . '/javascript/vendor/fastclick.js' );
	wp_enqueue_script( 'bootstrap_script', get_bloginfo( 'template_url' ) . '/javascript/vendor/bootstrap.min.js' );
        wp_enqueue_script( 'equal_heights_script', get_bloginfo( 'template_url' ) . '/javascript/jquery.equal-height-columns.js' );
	wp_enqueue_script( 'general_script', get_bloginfo( 'template_url' ) . '/javascript/general.js' );
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="ie ie6 lte9 lte8 lte7"><![endif]-->
<!--[if IE 7]><html <?php language_attributes(); ?> class="ie ie7 lte9 lte8 lte7"><![endif]-->
<!--[if IE 8]><html <?php language_attributes(); ?> class="ie ie8 lte9 lte8"><![endif]-->
<!--[if IE 9]><html <?php language_attributes(); ?> class="ie ie9 lte9"><![endif]-->
<!--[if gt IE 9]><html <?php language_attributes(); ?> class="ie"><![endif]-->
<!--[if !IE]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title><?php echo default_get_page_title(); ?></title>
	
	<!-- fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900' rel='stylesheet' type='text/css'>
	
	<!-- css -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/vendor/normalize.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/vendor/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/vendor/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/style.css" />
	
	<!-- dublin core -->	
	<meta name="dcterms.publisher" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
	<meta name="dcterms.title" content="<?php echo esc_attr( default_get_page_title() ); ?>" />
	<meta name="dcterms.identifier" content="<?php echo esc_attr( get_bloginfo( 'url' ) ); ?>" />
	<meta name="dcterms.language" content="<?php echo str_replace( '-', '_', get_bloginfo( 'language' ) ) ?>" />
	
	<!-- share image -->
	<?php
		$share_image = default_get_share_image();
		
		if ( $share_image != '' ) {
			?>
			<link rel="image_src" type="image/jpeg" href="<?php echo esc_attr( $share_image ); ?>" />
			<meta property="og:image" content="<?php echo esc_attr( $share_image ); ?>" />
			<?php
		}
	?>
	
	<!-- favicon -->
	<link rel="Shortcut Icon" type="image/x-icon" href="<?php bloginfo( 'template_directory' ); ?>/images/favicon.ico" />
	
	<!-- apple touch icons -->
	<link rel="apple-touch-icon" href="<?php bloginfo( 'template_url' ); ?>/images/touch-icon-iphone.png" /><!-- 57x57 -->
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo( 'template_url' ); ?>/images/touch-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo( 'template_url' ); ?>/images/touch-icon-iphone4.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo( 'template_url' ); ?>/images/touch-icon-ipad3.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo( 'template_url' ); ?>/images/touch-icon-ipad-ios7.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo( 'template_url' ); ?>/images/touch-icon-iphone-retina-ios7.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo( 'template_url' ); ?>/images/touch-icon-ipad-retina-ios7.png" />
	
	<!--[if IE]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/ie.css" />
	<![endif] -->
	<!--[if lte IE 9]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/ie8.css" />
		  
	    <script src="<?php bloginfo ('template_url') ?>/javascript/vendor/html5shiv.min.js"></script>
	    <script src="<?php bloginfo ('template_url') ?>/javascript/vendor/html5shiv-printshiv.min.js"></script>
	    <script src="<?php bloginfo ('template_url') ?>/javascript/vendor/respond.min.js"></script>
	    <script src="<?php bloginfo ('template_url') ?>/javascript/vendor/placeholders.min.js"></script>
	<![endif] -->
    
	<?php
		wp_head();
	?>
        
        <?php
            $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
            if (is_singular( 'post' ) ) {
        ?>
                <meta property="og:title" content="<?php the_title(); ?>" />
                <meta property="og:image" content="<?php echo $post_thumbnail[0]; ?>" />
        <?php
            }
        ?>
</head>

<?php
	$extra_body_classes = array();
	if ( default_get_current_language() != '' ) {
		$extra_body_classes[] = 'lang_' . default_get_current_language();
	}
?>
<body <?php body_class( implode( $extra_body_classes, ' ' ) ); ?>>

<?php if ( $share_image != '' ) { ?>
	<img class="page_share_image hide" src="<?php bloginfo( 'template_directory' ) ?>/images/logo_share.jpg" width="200" height="200" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
<?php } ?>

<!--[if lte IE 7]>
<p class="browsehappy"><?php _e( 'You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'AGX' ); ?></p>
<![endif]-->

<div class="page">
	<header class="header">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="navbar-header">
                            <a class="navbar-brand xs-margin" href="<?php echo esc_url( home_url('/')); ?>">
                                <img src="<?php echo bloginfo( 'template_directory' );?>/images/logo.png" alt=""/>
                            </a>
                            <button type="button" class="navbar-toggle open" data-toggle="collapse" data-target="#main-menu">
                                <i class="fa fa-navicon"></i>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="main-menu">
                            <?php  
                                $menu_defaults = array(
                                    'theme_location'    => 'primary'
                                );

                            ?>
                            <?php wp_nav_menu( $menu_defaults ); ?>
                        </div>
                        
                        
                    </div><!-- .row -->
                </div><!-- .container -->
            </nav>
		
		
	</header><!-- .header -->
	
    <div role="main" class="cf">