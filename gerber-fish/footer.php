			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
        <!--<div class="salt-water-note"><h3>NEW SALTWATER FISHING COLLECTION ON THE HORIZON</h3></div>-->
				<div id="inner-footer" class="wrap cf">

					<div class="footer-left">
            <nav role="navigation">
              <?php wp_nav_menu(array(
                'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
                'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
                'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
                'menu_class' => 'footer-nav cf',            // adding custom nav class
                'theme_location' => 'footer-links',             // where it's located in the theme
                'before' => '',                                 // before the menu
                'after' => '',                                  // after the menu
                'link_before' => '',                            // before each link
                'link_after' => '',                             // after each link
                'depth' => 0,                                   // limit the depth of the nav
                'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
              )); ?>
            </nav>
          </div>
          <div class="footer-right">
            <?php wp_nav_menu(array(
                'container' => '',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
                'container_class' => '',         // class of container (should you choose to use it)
                'menu' => __( 'Footer Social Links', 'bonestheme' ),   // nav name
                'menu_class' => '',            // adding custom nav class
                'theme_location' => '',             // where it's located in the theme
                'before' => '',                                 // before the menu
                'after' => '',                                  // after the menu
                'link_before' => '',                            // before each link
                'link_after' => '',                             // after each link
                'depth' => 0,                                   // limit the depth of the nav
                'fallback_cb' => 'bones_footer_links_fallback',  // fallback function
                'items_wrap' => '<ul class="social-links"><li class="social-links-title">Join the conversation:</li>%3$s</ul>'
              )); ?>
            <div class="copyright">
              <span>&copy;Gerber Gear | </span><a href="http://www.gerbergear.com/Company/Privacy-Policy" target="_blank">Privacy Policy</a> | <a href="http://www.gerbergear.com/Company/Terms-of-Use" target="_blank">Terms</a>
            </div>
          </div>

				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
    <script src="//cdn.jsdelivr.net/youtube-google-analytics/8.0.2/lunametrics-youtube.gtm.min.js"></script>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
