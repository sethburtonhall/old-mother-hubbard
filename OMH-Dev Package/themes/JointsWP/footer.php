<?php
/**
 * The template for displaying the footer.
 *
 * Comtains closing divs for header.php.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
 ?>

				<footer class="footer" role="contentinfo">

          <div class="main-footer-nav">
        		<div class="grid-container">
        			<div class="grid-container grid-x grid-margin-x grid-padding-x">

        				<div class="small-12 large-3 cell">
                  <p class="text-center large-text-left">
                    <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer-logo.svg" class="footer-logo" alt="<?php bloginfo('name'); ?>"/></a>
                  </p>
                </div>
                <div class="large-3 cell text-center large-text-left">
                  <h5 class="show-for-large">Let's Talk</h5>
                  <p class="address"><span class="phone"><a href="tel:3367930890">336.793.0890</a></span><br />
                  <span>751 West Fourth Street,</span> <span>Suite 310</span><br />
                  Winston-Salem, NC 27101</p>
                </div>
                <div class="large-2 cell show-for-large">
                  <h5>Company</h5>
                  <ul>
                    <!-- <li><a href="">About Us</a></li>
                    <li><a href="">Listings</a></li>
                    <li><a href="">Contact</a></li> -->
                    <?php joints_footer_company_nav(); ?>
                  </ul>
                </div>
                <div class="large-2 cell show-for-large">
                  <h5>Services</h5>
                  <ul>
                    <!-- <li><a href="">Brokerage</a></li>
                    <li><a href="">Properly Management</a></li>
                    <li><a href="">Development</a></li> -->
                    <?php joints_footer_services_nav(); ?>
                  </ul>
                </div>
                <div class="large-2 cell text-center large-text-right">
                  <?php joints_social_links(); ?>
                </div>
              </div>
            </div>
          </div>

          <div class="sub-footer-nav">
        		<div class="grid-container">
        			<div class="grid-container grid-x grid-margin-x grid-padding-x">
                <div class="small-12 large-6 cell text-center large-text-left">
                  <p class="copyright">
                    Firm Licensed in the State of North Carolina<br />
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
                  </p>
                  <hr class="address-hr hide-for-large"/>
                </div>
                <div class="small-12 large-6 cell text-center large-text-right">
                  <p class="devby">
                    Website Designed and Developed by Wildfire
                  </p>
                </div>
              </div>
            </div>
          </div>

				</footer> <!-- end .footer -->

			</div>  <!-- end .off-canvas-content -->

		</div> <!-- end .off-canvas-wrapper -->

		<?php wp_footer(); ?>


	</body>

</html> <!-- end page -->
