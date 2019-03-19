<footer class="footer footer_default footer_v1">

	<div class="info"><div class="container">
		<?php if( is_active_sidebar('footer_info') ){ ?>
			<div class="footer_info">
				
				<div class="wrap_slide2_nav"><div class="content px-5"><div class="bg">
					<?php dynamic_sidebar('footer_info'); ?>	

				</div></div></div>

				
			</div>
		<?php } ?>
	</div></div>
	<div class="container"><div class="row top">
		<div class="col-lg-3 col-md-6">
			<?php if( is_active_sidebar('footer_col1') ){ ?>
				<div class="footer_col1">
					<?php dynamic_sidebar('footer_col1'); ?>
				</div>
			<?php } ?>
		</div>
		<div class="col-lg-3 col-md-6">
			<?php if( is_active_sidebar('footer_col2') ){ ?>
				<div class="footer_col2">
					<?php dynamic_sidebar('footer_col2'); ?>
				</div>
			<?php } ?>
		</div>
		<div class="col-lg-3 col-md-6">
			<?php if( is_active_sidebar('footer_col3') ){ ?>
				<div class="footer_col3">
					<?php dynamic_sidebar('footer_col3'); ?>
				</div>
			<?php } ?>
		</div>
		<div class="col-lg-3 col-md-6">
			<?php if( is_active_sidebar('footer_col4') ){ ?>
				<div class="footer_col4">
					<?php dynamic_sidebar('footer_col4'); ?>
				</div>
			<?php } ?>
		</div>
	</div></div>

	<div class="container"><div class="row bottom">
		<div class="col-md-12">
			<?php if( is_active_sidebar('footer_social') ){ ?>
				<div class="footer_social">
					<?php dynamic_sidebar('footer_social'); ?>
				</div>
			<?php } ?>
		</div>
		<div class="col-md-12">
			<?php if( is_active_sidebar('footer_copyright') ){ ?>
				<div class="footer_copyright">
					<?php dynamic_sidebar('footer_copyright'); ?>
				</div>
			<?php } ?>
		</div>
	</div></div>

</footer>