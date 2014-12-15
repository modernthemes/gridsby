<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package gridsby
 */
?>

	</section><!-- #content --> 

	<footer id="colophon" class="site-footer" role="contentinfo">
		
        <div class="site-info">
        
		<?php if ( get_theme_mod( 'gridsby_footer_phone' ) ) : ?>
        	<h3><?php echo get_theme_mod( 'gridsby_footer_phone' ); ?></h3>
        <?php endif; ?>
        
        <?php if ( get_theme_mod( 'gridsby_footer_contact' ) ) : ?>
        <h3><?php echo get_theme_mod( 'gridsby_footer_contact' ); ?></h3>
        <?php endif; ?> 
			
		<?php if ( get_theme_mod( 'gridsby_footerid' ) ) : ?>     
        	<?php echo get_theme_mod( 'gridsby_footerid' ); ?>  
		<?php else : ?>  
    		<?php	printf( __( 'Theme: %1$s by %2$s', 'gridsby' ), 'gridsby', '<a href="http://modernthemes.net" rel="designer">modernthemes.net</a>' ); ?> 
		<?php endif; ?> 
		
        </div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
