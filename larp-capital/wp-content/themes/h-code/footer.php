<?php
/**
 * The template for displaying the footer
 *
 * @package H-Code
 */
?>
<footer class="bg-light-gray2 hcode-main-footer">
	<?php
		get_template_part( 'templates/footer', 'wrapper' );
		get_template_part( 'templates/footer' );
	?>
</footer>
<?php
	// Close Div For Ajax Popup
    hcode_add_ajax_page_div_footer( get_the_ID() );

	// Set Footer for Ajax Popup.
	hcode_set_footer( get_the_ID() );
	wp_footer();
?>
</body>
</html>