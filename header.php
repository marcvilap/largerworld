<?php
/**
 * Header
 *
 * @package WordPress
 */

?>
<!DOCTYPE html>

<head>
	
	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3M1JJ7VMX9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3M1JJ7VMX9');
</script>

   
	
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="font-sf md:text-2xl">
        <div class="flex h-24 items-center px-8 xl:px-16">
            <a class="group mr-auto flex items-center" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <svg class="group-hover:animate-spin mr-4 w-12 fill-violet-700 md:w-16" viewBox="0 0 64 64">
                    <path
                        d="m51.7 28.6-3.4.1 3.2-1.2c9.5-4 10.7-6.2 10-7.9-.7-1.7-3.1-2.3-12.7 1.7l-2.5 1.1 2-2c7.3-7.2 7.7-9.7 6.3-11-1.3-1.3-3.8-1-11 6.3a57 57 0 0 0-2.4 2.5l1.4-3.1C46.5 5.5 45.8 3 44 2.4c-1.7-.7-3.9.5-7.8 10.1l-1 2.6v-2.8C35.4 2 34 0 32 0s-3.4 2-3.4 12.3l.1 3.4-1.2-3.2c-4-9.5-6.2-10.7-7.9-10-1.7.7-2.3 3.1 1.7 12.7l1.1 2.5-2-2c-7.2-7.3-9.7-7.7-11-6.3-1.4 1.3-1 3.8 6.3 11a57 57 0 0 0 2.5 2.4L15 21.4C5.5 17.5 3 18.2 2.4 20c-.7 1.7.5 3.9 10.1 7.8l2.6 1h-2.8C2 28.6 0 30 0 32s2 3.4 12.3 3.4l3.4-.1-3.2 1.2c-9.5 4-10.7 6.2-10 7.9.7 1.7 3.1 2.3 12.7-1.7l2.5-1.1-2 2c-7.3 7.2-7.7 9.7-6.3 11 1.3 1.4 3.8 1 11-6.3l2.3-2.3-1.3 3c-3.9 9.5-3.2 12-1.5 12.6 1.7.7 3.9-.6 7.8-10.1l1-2.7v2.9C28.6 62 30 64 32 64s3.4-2 3.4-12.3l-.1-3.2 1.2 3c4 9.5 6.2 10.7 7.9 10 1.7-.7 2.3-3.2-1.7-12.7l-1.1-2.5 2 2c7.2 7.3 9.7 7.6 11 6.3 1.3-1.3 1-3.8-6.3-11a57 57 0 0 0-2.5-2.4l3.1 1.4c9.6 3.9 12 3.2 12.7 1.5.7-1.7-.6-3.9-10.1-7.8l-2.6-1h2.8C62 35.4 64 34 64 32s-2-3.4-12.3-3.4" />
                </svg>
                <span>larger.world</span>
            </a>


            <button id="hamburger" class="md:hidden focus:outline-none z-20" aria-label="Open menu">
                <span
                    class="hamburger-line block w-6 h-[0.2rem] bg-white my-[5px] transition duration-300 ease-in-out"></span>
                <span
                    class="hamburger-line block w-6 h-[0.2rem] bg-white my-[5px] transition duration-300 ease-in-out"></span>
                <span
                    class="hamburger-line block w-6 h-[0.2rem] bg-white my-[5px] transition duration-300 ease-in-out"></span>
            </button>

            <div id="menu"
                class=" bg-violet-700 z-10 md:bg-inherit top-0 right-0 absolute md:relative flex-col-reverse md:flex-row w-full md:w-auto h-full text-center items-center justify-center content-center hidden md:flex translate-x-full transition ease-in-out  duration-300 md:translate-x-0">
                <a target="_blank" href="https://www.linkedin.com/company/larger-world/?originalSubdomain=at">
                    <svg class="w-8 mt-8 md:mt-0 fill-current md:w-6" viewBox="0 0 24 24">
                        <path
                            d="M5.45 22.95V7.47H.3v15.48h5.15ZM2.87 5.35l.23.02a2.7 2.7 0 0 0 2.68-2.68A2.7 2.7 0 0 0 2.91 0h-.23A2.7 2.7 0 0 0 0 2.68a2.7 2.7 0 0 0 2.84 2.68h.03Zm5.42 17.6s.07-14.03 0-15.48h5.15v2.25h-.03a5.13 5.13 0 0 1 4.67-2.61c3.38 0 5.92 2.21 5.92 6.96v8.88h-5.15v-8.28c0-2.08-.74-3.5-2.6-3.5a2.8 2.8 0 0 0-2.64 1.88c-.14.4-.2.83-.17 1.25v8.65H8.29Z" />
                    </svg>
                </a>
                <?php
					wp_nav_menu(
						array(
						'theme_location' => 'header',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 1,
						'menu_class'     => 'hover-links-underline flex flex-col md:flex-row gap-4 md:ml-8 md:gap-8 text-4xl md:text-2xl',
						)
					);
				?>
            </div>
        </div>

    </header>