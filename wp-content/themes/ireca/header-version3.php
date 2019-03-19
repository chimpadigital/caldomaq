<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <?php wp_head(); ?>
</head>

<?php 
$lang = get_theme_mod( 'calendar_layout', 'en' ); 
$calendar_dis_weekend = get_theme_mod( 'calendar_dis_weekend', '0,6' );
$cal_time = get_theme_mod( 'calendar_time', '07:00, 07:30, 08:00, 08:30, 09:00, 09:30, 10:00, 10:30, 11:00, 11:30, 12:00, 12:30, 13:00, 13:30, 14:00, 14:30, 15:00, 15:30, 16:00, 16:30, 17:00, 17:30, 18:00' );
?>
<body <?php body_class(); ?> data-lang="<?php echo esc_attr( $lang ); ?>" data-time="<?php echo esc_attr( $cal_time ); ?>" data-disweek="<?php echo esc_attr($calendar_dis_weekend); ?>">

    <?php $bg = ireca_get_header_bg(); ?>

    <div class="ovatheme_container_<?php echo esc_attr(ireca_get_current_width_site()); ?> <?php echo esc_attr($bg['bg_class']); ?> woocommerce">

    	
		<header class="ovatheme_header_version3 header_m <?php  echo esc_attr( $bg['bg_class'] ); ?>">
			
			

			<div class="top d-none d-lg-block">
				<div class="container d-flex justify-content-between">
				
					<div class=" flex-grow-1 d-none d-md-none d-sm-none d-lg-block">
						<div class="logo">
							<a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand py-0">
								
								<?php if( $meta_logo = get_post_meta( ireca_get_current_id(), 'ireca_met_logo', true ) ){ ?>
									<img src="<?php  echo esc_url( $meta_logo ); ?>" alt="<?php bloginfo('name');  ?>">
								<?php }else if( get_theme_mod( 'logo', '' ) != '' ) { ?>
									<img src="<?php  echo esc_url( get_theme_mod('logo', '') ); ?>" alt="<?php bloginfo('name');  ?>">
								<?php }else { ?> <span class="blogname"><?php bloginfo('name');  ?></span><?php } ?>
								
							</a>
						</div>	
					</div>
					
					<?php if( is_active_sidebar('header3_info') ){ ?>
					<div class="d-none d-lg-block">
						<div class="beside_logo d-flex">
							<?php dynamic_sidebar('header3_info'); ?>
						</div>	
					</div>
					<?php } ?>
					
					<?php if( is_active_sidebar('header3_cart') ){ ?>
						<div class="float-sm-right d-none d-lg-block">
							<div class="cart d-flex">
								<?php dynamic_sidebar('header3_cart'); ?>
							</div>
						</div>
					<?php } ?>

				</div>

			</div>

			<?php $header_show_stick = get_theme_mod( 'header_show_stick', 'yes' ) == 'yes' ? 'ovamenu_shrink' : ''; ?>

			<div class="ova_menu <?php echo esc_attr($header_show_stick); ?>">
				<div class="container ">
					<div class="row">
						<div class="col-md-12">
					
							<nav class="navbar navbar-expand-lg py-0 px-0 ">


								<a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand d-md-block d-sm-block d-lg-none py-0">
									<?php if( $meta_logo = get_post_meta( ireca_get_current_id(), 'ireca_met_logo_mobile', true ) ){ ?>
										<img src="<?php  echo esc_url( $meta_logo ); ?>" alt="<?php bloginfo('name');  ?>">
									<?php }else if( get_theme_mod( 'logo_mobile', '' ) != '' ) { ?>
										<img src="<?php  echo esc_url( get_theme_mod('logo_mobile', '') ); ?>" alt="<?php bloginfo('name');  ?>">
									<?php }else { ?> <span class="blogname"><?php bloginfo('name');  ?></span><?php } ?>
								</a>	

								

								<div class="form-inline">

									<?php if( is_active_sidebar('header_d_t_cart') ){ ?>
										<div class=" d-block d-lg-none mr-2">
											<?php dynamic_sidebar('header_d_t_cart'); ?>
										</div>
									<?php } ?>
										
								  <button class="navbar-toggler text-right" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'ireca'); ?>">
								    <span class="navbar-toggler-icon"></span>
								    <span class="navbar-toggler-icon"></span>
								    <span class="navbar-toggler-icon"></span>
								  </button>
								  
								</div>

								  <div class="collapse navbar-collapse" id="mainmenu">
								  

								  	<?php 
						            wp_nav_menu( array(
						                'menu'              => '',
						                'theme_location'    => 'primary',
						                'depth'             => 3,
						                'container'         => '',
						                'container_class'   => '',
						                'container_id'      => '',
						                'menu_class'        => 'navbar-nav mr-auto',
						                'fallback_cb'       => 'ireca_wp_bootstrap_navwalker::fallback',
						                'walker'            => new ireca_wp_bootstrap_navwalker()
						            )); ?>

						            <?php if( is_active_sidebar('header3_search') ){ ?>
										<div class="form-inline header3_search mx-0  d-none d-lg-block">
											<?php dynamic_sidebar('header3_search'); ?>
										</div>
									<?php } ?>

								  </div>

							</nav>
						</div>
					</div>
				</div>
			</div>

		</header>

		<?php if( $bg['bg_url'] ){ ?>
			<div class="header_img header_version3" style="background: url( <?php echo esc_url( $bg['bg_url'] ); ?> )" >
				<div class="bg_overlay_header"></div>
				<div class="heading_page">
					<h1 class="page-title"><?php echo ireca_heading_title(); ?></h1>
					<?php echo ireca_breadcrumbs_header(); ?>
				</div>
			</div>
		<?php }else{ ?>
			<?php if( get_post_meta(  ireca_get_current_id() ,'ireca_met_page_heading', true ) != 'no' || get_post_meta(  ireca_get_current_id() ,'ireca_met_show_breadcrumbs', true ) != 'no' ){ ?>
			<div class="wrap_default_heading_page">
				<div class="container">
					<div class="heading_page">
						<h2 class="page_default_title"><?php echo ireca_heading_title(); ?></h2>
						<?php echo ireca_breadcrumbs_header(); ?>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
		

