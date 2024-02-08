<?php
/**
 * Footer
 *
 * @package WordPress
 */

?>

<footer class="reveal-group text-center overflow-hidden max-md:bg-violet-700 max-md:p-8">
	<div class="grid grid-cols-2 max-md:gap-8 max-md:pb-8 md:grid-cols-3 md:text-sm lg:text-[1.25vw] lg:leading-relaxed">
		<div class="reveal-fade-up flex items-center justify-center bg-violet-700 md:aspect-[2/1] md:rounded-t-full">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer1',
					'container'      => false,
					'fallback_cb'    => false,
					'depth'          => 1,
					'menu_class'     => 'hover-links-underline grid',
				)
			);
			?>
		</div>
		<div class="reveal-fade-up reveal-delay-100 flex items-center justify-center bg-violet-700 md:aspect-[2/1] md:rounded-t-full">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer2',
					'container'      => false,
					'fallback_cb'    => false,
					'depth'          => 1,
					'menu_class'     => 'hover-links-underline grid',
				)
			);
			?>
		</div>
		<div class="reveal-fade-up reveal-delay-200 flex items-center justify-center bg-violet-700 max-md:col-span-2 md:aspect-[2/1] md:rounded-t-full">
			<div><br><img src="https://api.thegreenwebfoundation.org/greencheckimage/larger.world?nocache=true" alt="This website is hosted Green - checked by thegreenwebfoundation.org"></div>
		</div>
	</div>
	<div class="relative z-10 bg-violet-700 text-sm md:leading-[3] lg:text-[1.1vw]">copyright © larger.world</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
