<?php
/**
 * Page
 *
 * @package WordPress
 */

get_header();
?>
<main>
	<div class="py-8 md:py-24">
		<div class="container">

			<h1 class="text-4xl lowercase"><?php the_title(); ?></h1>
			<div class="my-8 max-w-[46rem] text-xl md:my-12 md:text-3xl">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>

			<ul class="my-12 grid max-w-[46rem] gap-8 text-xl md:my-16 md:text-4xl">
				<?php foreach( get_categories() as $key => $category ) : ?>
				<li class="transition-transform duration-300 <?php echo esc_attr( $key % 2 === 0 ? 'rotate-1 hover:-rotate-1' : '-rotate-1 hover:rotate-1' ); ?>">
					<a class="block bg-violet-700 p-4" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
				</li>
				<?php endforeach; ?>
			</ul>

			<h2 class="mb-3 text-xl md:text-3xl"> </h2>
			<p class="mb-8 md:mb-12">
				we are a group of individuals from around the globe that have observed and worked in the field of DEI and sustainability for quite some years now. 
<br>&nbsp;<br>	
				one thing we all have in common: we are tired of observing sustainability and DEI as a trend and we are worried how the industry around sustainability is currently developing - especially when it comes to companies. 
<br>&nbsp;<br>	
that’s why we decided to take a turn and walk a new path - focusing on two things
				<br>&nbsp;<br>	
				<strong>1.</strong> unlearning - a process that invites you to take a few steps back from the patterns we all internally have - especially when it comes to succeeding in the fast thriving environment we are all working in. 
<br>&nbsp;<br>				
<strong>2.</strong> to look at DEI and sustainability in (for now) often unseen ways - and to give all of us the opportunity to explore these topics from new angles. 
<br>&nbsp;<br>	
the result is larger.world: an unlearning platform for DEI and sustainability managers and everyone who is open to approach those topics from new perspectives - in order to really contribute to the changes that are so urgently needed.
<br>&nbsp;<br>	
thank you for taking this journey with us!

			</p>
			

		</div>
	</div>

	<?php get_template_part( 'part', 'newsletter' ); ?>

</main>
<?php
get_footer();
