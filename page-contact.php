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

            <ul class="mb-8 grid gap-4 md:mb-12">
                <li class="flex items-center gap-4">
                    <svg class="w-8 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M21.75 4.2c1.15-.07 2.16.8 2.25 1.95a1.88 1.88 0 0 1-.9 1.56l-10.2 6.63a1.7 1.7 0 0 1-1.8 0L.9 7.71A1.88 1.88 0 0 1 0 6.15 2.13 2.13 0 0 1 2.25 4.2h19.5ZM10.2 15.38c1.1.7 2.5.7 3.6 0L24 8.75v8.45c0 1.44-1.35 2.6-3 2.6H3c-1.66 0-3-1.16-3-2.6V8.75l10.2 6.63Z" />
                    </svg>
                    <a class="hover:underline" href="mailto:hello@larger.world">drop us email on hello@larger.world</a>
                </li>
                <li class="flex items-center gap-4">
                    <svg class="w-8 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M5.45 22.95V7.47H.3v15.48h5.15ZM2.87 5.35l.23.02a2.7 2.7 0 0 0 2.68-2.68A2.7 2.7 0 0 0 2.91 0h-.23A2.7 2.7 0 0 0 0 2.68a2.7 2.7 0 0 0 2.84 2.68h.03Zm5.42 17.6s.07-14.03 0-15.48h5.15v2.25h-.03a5.13 5.13 0 0 1 4.67-2.61c3.38 0 5.92 2.21 5.92 6.96v8.88h-5.15v-8.28c0-2.08-.74-3.5-2.6-3.5a2.8 2.8 0 0 0-2.64 1.88c-.14.4-.2.83-.17 1.25v8.65H8.29Z" />
                    </svg>
                    <a class="hover:underline" href="https://www.linkedin.com/company/larger-world/">join our community
                        on LinkedIn</a>
                </li>
            </ul>
            <p class="max-w-[16rem] text-orange-500 underline">
                c/o Widelake Bakery Breitenseerdtraße 30b 1140 Vienna Austria
            </p>
        </div>
    </div>

    <?php get_template_part( 'part', 'newsletter' ); ?>

</main>
<?php
get_footer();