<?php
/**
 * Page
 *
 * @package WordPress
 */

get_header();
?>
<main class="container py-8 md:py-24">
	<h1 class="mb-8 text-4xl lowercase md:mb-12"><?php the_title(); ?></h1>
	<div class="prose">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>
</main>
<?php
get_footer();
