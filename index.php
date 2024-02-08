<?php
/**
 * Page
 *
 * @package WordPress
 */

$type   = $_GET['type'] ?? null;
$impact = $_GET['impact'] ?? null;

get_header();
?>
<main>
    <div class="py-8 md:py-24">
        <div class="container">
            <form class="mb-8 md:mb-12">
                <div class="flex">
                    <input class="input-text h-20 border-none bg-white p-6 text-left text-orange-500" type="search"
                        name="s" placeholder="What are you looking for?" value="<?php the_search_query(); ?>" />
                    <button class="h-20 w-20 shrink-0 bg-orange-500 p-6">
                        <svg class="fill-current" viewBox="0 0 24 24">
                            <path
                                d="M9 0h-.03A9.02 9.02 0 0 0 0 8.98a8.97 8.97 0 0 0 14.9 6.75l8.03 8.04a.6.6 0 1 0 .9-.8.61.61 0 0 0-.05-.04l-8.04-8.05A8.97 8.97 0 0 0 9 0m0 1.2a7.82 7.82 0 0 1 7.77 7.78A7.82 7.82 0 0 1 9 16.76a7.82 7.82 0 0 1-7.78-7.78A7.8 7.8 0 0 1 8.99 1.2" />
                        </svg>
                    </button>
                </div>
                <div class="mt-4 grid gap-4 md:grid-cols-3">
                    <a class="button bg-orange-500"
                        href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>">All</a>
                    <div class="relative">
                        <select class="input-text cursor-pointer bg-white text-left text-neutral-800" name="type">
                            <option value="">Type of resource</option>
                            <option value="article" <?php selected( $type, 'article' ); ?>>article</option>
                            <option value="document" <?php selected( $type, 'document' ); ?>>document</option>
                            <option value="event" <?php selected( $type, 'event' ); ?>>event</option>
                            <option value="podcast" <?php selected( $type, 'podcast' ); ?>>podcast</option>
                            <option value="video" <?php selected( $type, 'video' ); ?>>video</option>
                        </select>
                        <svg class="absolute right-6 top-1/2 -mt-2 w-4 fill-neutral-800" viewBox="0 0 24 24">
                            <path
                                d="m12 14.72 9.08-9.08a1.7 1.7 0 0 1 2.42 0c.67.67.67 1.77 0 2.44L13.22 18.37c-.65.64-1.7.66-2.37.05L.51 8.08a1.72 1.72 0 0 1 2.42-2.44L12 14.72Z" />
                        </svg>
                    </div>
                    <div class="relative">
                        <select class="input-text cursor-pointer bg-white text-left text-neutral-800" name="impact">
                            <option value="">impact field</option>
                            <?php foreach( get_categories() as $key => $category ) : ?>
                            <option value="<?php echo esc_html( $category->slug ); ?>"
                                <?php selected( $impact, $category->slug ); ?>>
                                <?php echo esc_html( $category->name ); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <svg class="absolute right-6 top-1/2 -mt-2 w-4 fill-neutral-800" viewBox="0 0 24 24">
                            <path
                                d="m12 14.72 9.08-9.08a1.7 1.7 0 0 1 2.42 0c.67.67.67 1.77 0 2.44L13.22 18.37c-.65.64-1.7.66-2.37.05L.51 8.08a1.72 1.72 0 0 1 2.42-2.44L12 14.72Z" />
                        </svg>
                    </div>
                </div>
            </form>

            <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            <article class="mb-8 border-b border-neutral-600 pb-8">
                <h2 class="mb-3 text-xl md:text-3xl"><?php the_title(); ?></h2>
                <div class="flex justify-between gap-8 max-md:flex-col">
                    <div>
                        <div class="mb-4 max-w-[46rem]">
                            <p><?php the_excerpt(); ?></p>
                        </div>
                        <a class="inline-flex items-center gap-4 transition-colors duration-300 hover:text-orange-500"
                            href="<?php the_permalink(); ?>">
                            <span class="font-medium">read more</span>
                            <svg class="w-8 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M0 12.6v-1.2h21.99l-7.78-7.82.84-.83 8.78 8.83a.6.6 0 0 1-.42 1.01H0ZM18.6 16l.84.83-4.39 4.42-.84-.83L18.6 16Z" />
                            </svg>
                        </a>
                    </div>
                    <div>
                        <svg class="h-20 w-20 border border-white fill-current p-4 md:h-40 md:w-40 md:p-8"
                            viewBox="0 0 24 24">
                            <?php if ( has_post_format('link') ) : ?>
                            <path
                                d="M18.69 2.3v1.92h-1.92V2.3h1.92ZM16.4 0v1.92h-1.9V0h1.91ZM6.76 6.9v1.9H4.85V6.9h1.91ZM21 6.9v1.9h-1.92V6.9H21ZM4.93 0v1.92H3V0h1.92ZM9.5 2.3v1.92H7.6V2.3h1.9Zm2.3 2.3v1.9H9.88V4.6h1.92Zm0-2.29v1.92H9.88V2.3h1.92ZM9.5 0v1.92H7.6V0h1.9Zm4.59 4.59V6.5h-1.92V4.6h1.92ZM7.21 0v1.92H5.29V0h1.92Zm6.43 11.48v1.91h-1.92v-1.91h1.92Zm-4.6 1.68v1.92h-1.9v-1.92h1.9Zm0-3.97v1.92h-1.9V9.19h1.9Zm8.27 11.35v-.02c0-.1.09-.2.2-.2h3.19l-3.39 3.41v-3.2Zm-.98-11.35h4.62v10.77H17.5a.58.58 0 0 0-.58.58V24H4.17a.2.2 0 0 1-.2-.2V13.17h2.78v2.11c0 .1.08.18.18.18h2.32c.1 0 .19-.08.19-.18v-1.5h6.7c.1 0 .19-.08.19-.18V9.19Zm2.36-4.6V6.5h-1.92V4.6h1.92Zm-7.36 6.89v1.91h-1.9v-1.91h1.9Zm4.59-2.29v1.92h-1.9V9.19h1.9Zm0 2.29v1.91h-1.9v-1.91h1.9Z" />
                            <?php elseif ( has_post_format('status') ) : ?>
                            <path
                                d="M24 6.2v16.2c0 .6-.5 1.1-1.1 1.1H3.83c-.6 0-1.1-.5-1.1-1.1v-.82h17.44a1.9 1.9 0 0 0 1.9-1.9V5.11h.83c.6 0 1.1.5 1.1 1.1Zm-2.74-2.73c0-.6-.5-1.1-1.1-1.1h-1.11v1.15a1.8 1.8 0 0 1-1.8 1.64 1.8 1.8 0 0 1-1.78-1.64V2.38H12.5v1.14a1.8 1.8 0 0 1-1.8 1.73 1.8 1.8 0 0 1-1.8-1.73V2.38H5.94v1.18c0 .96-.79 1.75-1.75 1.75H4.1c-.96 0-1.75-.79-1.75-1.75V2.38H1.1c-.6 0-1.1.49-1.1 1.09v2.78h21.26V3.47Zm-16.12.05V1.44a1 1 0 0 0-1-.94 1 1 0 0 0-.99.94v2.08c0 1.32 2 1.32 2 0Zm6.56 0V1.44a1 1 0 0 0-1-.94 1 1 0 0 0-1 .94v2.08c0 1.32 2 1.32 2 0Zm6.55 0V1.44a1 1 0 0 0-1-.94 1 1 0 0 0-1 .94v2.08c.02 1.32 2 1.32 2 0Zm1.92 17.26H1.1c-.6 0-1.1-.5-1.1-1.1V7.04h21.26v12.64c0 .6-.5 1.1-1.1 1.1ZM4.8 18.47v-1.2c0-.3-.24-.55-.54-.55h-1.2c-.3 0-.54.25-.54.55v1.2c0 .3.24.54.54.55h1.2c.3 0 .54-.25.54-.55Zm0-5.16c0-.3-.25-.54-.54-.53h-1.2a.55.55 0 0 0-.54.53v1.2c.01.29.25.53.54.53h1.2c.3 0 .54-.24.54-.53v-1.2Zm4.65 3.96c0-.3-.24-.54-.54-.55h-1.2c-.3 0-.54.25-.54.55v1.2c0 .3.24.54.54.55h1.2c.3-.01.54-.26.54-.55v-1.2Zm0-3.96a.55.55 0 0 0-.54-.53h-1.2a.54.54 0 0 0-.54.53v1.2c0 .3.25.53.54.53h1.2c.3 0 .53-.24.54-.53v-1.2Zm0-3.96a.55.55 0 0 0-.54-.53h-1.2a.54.54 0 0 0-.54.53v1.2c0 .3.24.55.54.55h1.2c.3-.01.54-.26.54-.55v-1.2Zm4.64 7.92c0-.3-.24-.54-.53-.55h-1.2c-.3 0-.54.25-.54.55v1.2c0 .3.24.54.54.55h1.2c.3-.01.53-.26.53-.55v-1.2Zm0-3.96a.55.55 0 0 0-.53-.53h-1.2a.55.55 0 0 0-.54.53v1.2c0 .29.25.52.54.53h1.2c.28 0 .52-.24.53-.53v-1.2Zm0-3.96a.55.55 0 0 0-.53-.53h-1.2a.55.55 0 0 0-.54.53v1.2c0 .3.24.54.54.55h1.2a.56.56 0 0 0 .53-.55v-1.2Zm4.64 7.92c0-.3-.24-.54-.53-.55H17c-.3 0-.54.25-.54.55v1.2c0 .3.24.54.54.55h1.2c.3-.01.53-.26.53-.55v-1.2Zm0-3.96a.55.55 0 0 0-.53-.53H17a.55.55 0 0 0-.54.53v1.2c0 .29.25.52.54.53h1.2c.29 0 .52-.24.53-.53v-1.2Zm0-3.96a.55.55 0 0 0-.53-.53H17a.55.55 0 0 0-.54.53v1.2c0 .3.24.54.54.55h1.2a.56.56 0 0 0 .53-.55v-1.2Z" />
                            <?php elseif ( has_post_format('audio') ) : ?>
                            <path
                                d="M12.57 11.43v2.93a5.1 5.1 0 0 1-5.07 5.07h-.14a5.1 5.1 0 0 1-5.07-5.14v-2.86h10.28ZM8.63 2.4C8.22 3.26 8 4.2 8 5.14a6.36 6.36 0 0 0 2.69 5.15h-8.4V7.36a5.1 5.1 0 0 1 5.14-5.07c.4-.02.8.02 1.2.11ZM24 5.12v.04a5.15 5.15 0 0 1-5.12 5.13h-1.85a.5.5 0 0 0-.4.17l-1.94 1.94a.52.52 0 0 1-.63.11.5.5 0 0 1-.35-.51v-1.26a.56.56 0 0 0-.45-.57 5.11 5.11 0 0 1-4.12-5.03v-.02A5.15 5.15 0 0 1 14.26 0h4.62A5.15 5.15 0 0 1 24 5.12ZM13.71 2.86v4.57c0 .31.26.57.58.57.3 0 .57-.26.57-.57V2.86a.57.57 0 0 0-.57-.57.57.57 0 0 0-.58.57ZM11.43 4v2.3c0 .3.26.57.57.57.31 0 .57-.26.57-.57V4a.57.57 0 0 0-.57-.57.57.57 0 0 0-.57.57Zm6.86-1.14v4.57a.57.57 0 1 0 1.14 0V2.86a.57.57 0 0 0-.57-.57.57.57 0 0 0-.57.57ZM20.57 4v2.3c0 .3.26.57.57.57.32 0 .57-.26.57-.57V4a.57.57 0 0 0-.57-.57.57.57 0 0 0-.57.57ZM16 1.71v6.86a.57.57 0 1 0 1.14 0V1.71a.57.57 0 0 0-.57-.57.57.57 0 0 0-.57.57ZM8 22.86h1.71c.32 0 .58.25.58.57 0 .31-.26.57-.58.57H5.14a.57.57 0 0 1-.57-.57c0-.32.26-.57.57-.57h1.72V21.7A7.5 7.5 0 0 1 0 14.3c0-.32.26-.58.57-.58.32 0 .57.26.57.58v.01a6.3 6.3 0 0 0 6.27 6.27h.04a6.3 6.3 0 0 0 6.26-6.27v-.01a.57.57 0 1 1 1.14 0c.02 3.86-3 7.13-6.85 7.42v1.15Z" />
                            <?php elseif ( has_post_format('video') ) : ?>
                            <path
                                d="M23.5 6.2c.5 1.89.5 5.82.5 5.82s0 3.93-.5 5.81a2.97 2.97 0 0 1-2.12 2.1c-1.87.5-9.38.5-9.38.5s-7.5 0-9.38-.5a2.97 2.97 0 0 1-2.12-2.1C0 15.95 0 12.02 0 12.02S0 8.09.5 6.2a3.02 3.02 0 0 1 2.13-2.13c1.87-.5 9.37-.5 9.37-.5s7.5 0 9.38.5A3.02 3.02 0 0 1 23.5 6.2ZM9.55 15.6l6.27-3.57-6.27-3.57v7.14Z" />
                            <?php else : ?>
                            <path
                                d="M23.66 2.09c.17 0 .32.13.34.3v13.05c0 .1-.03.18-.1.25a.57.57 0 0 1-.21.06h-2.03v1.77c.78.17 1.4.74 1.62 1.5.04.06.06.12.07.19v.03l.03.18v.25c-.01.6-.25 1.16-.66 1.59a2.2 2.2 0 0 1-1.58.65H9.56c-.04 0-.07-.03-.1-.03H9.4l-2.12-1.37c-.03 0-.06-.03-.09-.06H3.33c-.94 0-1.7-.78-1.71-1.71v-7.6H.29a.3.3 0 0 1-.29-.3V6.76c0-.16.13-.3.3-.3h1.3V4.71a.3.3 0 0 1 .3-.29h2.07V2.38c0-.16.14-.3.3-.3h19.38ZM9.37 17.43h11.64V5.01H2.24v1.43h8.8c.16 0 .3.14.3.3v4.08a.3.3 0 0 1-.3.3h-8.8v7.59c0 .6.5 1.08 1.1 1.09h3.45v-.28c.04-.13.09-.26.15-.38l.03-.03c.07-.03.1-.1.13-.12.04-.05.1-.1.15-.13l.38-.25 1.74-1.18Zm1.62-1.8H11c.17 0 .32.13.32.3v.03a.3.3 0 0 1-.3.29H4.3a.31.31 0 0 1-.32-.31c0-.17.14-.31.32-.31h6.69Zm8.22-3.96c.16.01.3.15.3.31v3.98a.3.3 0 0 1-.29.29h-6.75a.3.3 0 0 1-.3-.3v-3.97a.3.3 0 0 1 .31-.3h6.73Zm0-3.55c.17 0 .3.15.3.32v.01a.3.3 0 0 1-.29.3h-6.74a.31.31 0 0 1-.3-.31.3.3 0 0 1 .3-.31h6.73Zm0 1.66c.17 0 .3.14.3.3v.02a.3.3 0 0 1-.29.3h-6.74a.31.31 0 0 1-.3-.31.3.3 0 0 1 .3-.31h6.73Zm0-3.3c.17 0 .3.14.3.3v.03a.3.3 0 0 1-.29.29h-6.74a.31.31 0 0 1-.3-.31.3.3 0 0 1 .3-.31h6.73Zm-8.22 5.82H11c.17 0 .32.13.32.3v.02a.3.3 0 0 1-.3.3H4.3a.31.31 0 0 1-.32-.31c0-.17.14-.31.32-.31h6.69Zm0 1.65H11c.17 0 .32.14.32.3v.02a.3.3 0 0 1-.3.3H4.3a.31.31 0 0 1-.32-.31c0-.17.14-.31.32-.31h6.69Zm7.9 7.31v-.6H9.88v.6h9.03ZM2.13 10.5h2.55l.19-.22-.9-1.15a.5.5 0 0 0-.75 0L2.1 10.5Zm16.77 9.56v-.75H9.88v.75h9.03Zm2.77-1.87a.52.52 0 0 0-.15-.06c-.06 0-.1-.03-.16-.03a.66.66 0 0 0-.25-.04h-.24v3.18h.25a1.58 1.58 0 0 0 1.58-1.59c0-.1 0-.2-.03-.3-.03-.04-.03-.04-.03-.07a.6.6 0 0 0-.06-.25c0-.03-.03-.03-.03-.06a.79.79 0 0 0-.13-.22l-.03-.03a.8.8 0 0 0-.15-.19l-.04-.03-.18-.15c-.03 0-.03-.04-.06-.04l-.2-.09c-.02 0-.05-.03-.08-.03Zm-16.15-7.7h4.23L8 8.3a.44.44 0 0 0-.37-.2.45.45 0 0 0-.38.2l-1.74 2.2Zm13.38 8.19v-.63H9.87v.63h9.02Z" />
                            <?php endif; ?>
                        </svg>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>

            <?php if ( paginate_links() ) : ?>
            <div class="pagination"><?php echo paginate_links(); ?></div>
            <?php endif; ?>

            <?php else : ?>

            <h2 class="text-xl md:text-3xl">ooops we got busted! we are currently finalizing our search function and in
                a few days, you will be able to scroll through all our content whenever you wish. till then, let us know
                what are you most interested.<br>
                <br><a href="https://larger.world/type-your-questions-thoughts-here">type your questions/thoughts
                    here</a>
            </h2>

            <br>


            <?php endif; ?>

        </div>
    </div>

    <?php get_template_part( 'part', 'newsletter' ); ?>

</main>
<?php
get_footer();