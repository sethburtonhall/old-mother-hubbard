<?php
/**
 * The off-canvas menu uses the Off-Canvas Component
 *
 * For more info: http://jointswp.com/docs/off-canvas-menu/
 */
?>

<div class="top-bar" id="top-bar-menu">

	<div class="main-bar">
		<div class="grid-container">
			<div class="grid-container grid-x grid-margin-x grid-padding-x">

				<div class="small-8 large-4 cell text-left main-logo-container">
					<a href="/">
						<img src="" alt="" class="main-logo" />
					</a>
				</div>

				<div class="small-2 large-0 show-for-small-up hide-for-large text-center mobile-burger-container">
					<button class="menu-burger" type="button" data-toggle="off-canvas-nav"><span>Open/Close Menu</span></button>
				</div>

				<div class="large-8 cell show-for-large">
					<ul class="medium-horizontal menu">
						<li>
							<a href="#">Treats</a>
						</li>
						<li>
							<a href="#">The Bakery</a>
						</li>
						<li><a href="#">The Biscuit Blog</a></li>
						<li>
							<a href="#">Connect</a>
						</li>
					</ul>
				</div>

			</div>
		</div>
	</div>

	<?php /*
	<div class="top-bar-left float-left">
		<ul class="menu">
			<li><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></li>
		</ul>
	</div>
	<div class="top-bar-right show-for-medium">
		<?php joints_top_nav(); ?>
	</div>
	<div class="top-bar-right float-right show-for-small-only">
		<ul class="menu">
			<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
			<li><a data-toggle="off-canvas"><?php _e( 'Menu', 'jointswp' ); ?></a></li>
		</ul>
	</div>
	*/ ?>
</div>

<div class="top-bar-offset"></div>
