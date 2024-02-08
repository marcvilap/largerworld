<?php
/**
 * Page
 *
 * @package WordPress
 */

$action = $_GET['action'] ?? null;
$plan   = $_GET['plan'] ?? null;
$categories = [
    ["title" => "Planet Earth", "url" => "/scenes/planet/"],
    ["title" => "Community"],
    ["title" => "Customers/Users"],
    ["title" => "Funders/Investors"],
    ["title" => "Co-creators"]
];


get_header();
?>
<style>
.blur {
    filter: blur(2.5px);
}
</style>

<main class="container py-8 md:py-24">
    <video autoplay="" loop="" muted="" playsinline="" style="
    width: 70%;
    margin: 0 auto;
">
        <source src="https://larger.world/wp-content/uploads/intro_worlds.mp4" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">

    </video>


    <h1 class="mb-6 text-center text-3xl md:text-5xl">welcome to larger.world</h1>
    <p class="mx-auto mb-8 max-w-2xl text-center md:mb-12">
        larger.world hosts worlds of unique and unseen content, around the topics of diversity, inclusion, equity,
        sustainability and regeneration. we invite you on a journey of unlearning, through rainforests of content,
        office chaos and more. sign up now and start exploring soon.
        <br>&nbsp;<br>sign up now and get a buzz when our worlds open their doors.<br>

    <div class="flex justify-center mb-20">
        <div id="wonder" class="p-8 text-center bg-orange-500 inline-block"><a
                href="https://larger.world/about/carbon-neutrality-efforts" style=" color: white; ">wonder why our page
                is
                black&nbsp; &nbsp; →</a></div>
    </div>


    </p>

    <!--<img src="https://larger.world/wp-content/uploads/worlds.png" style=" width: 92%; margin: 0 auto; ">-->


    <div class="grid gap-8 text-center font-bold md:grid-cols-5 mt-8">

        <?php foreach( $categories as $category ) : ?>
        <a class="group transition-colors duration-300 <?php echo isset($category['url']) ? 'hover:text-violet-500' : 'blur'; ?>"
            href="<?php echo esc_url( $category['url']  ); ?>">
            <svg class="mx-auto mb-4 w-16 fill-current <?php echo isset($category['url']) ? 'hover:text-violet-500 group-hover:animate-spin' : ''; ?>"
                viewBox="0 0 64 64">
                <path
                    d="m51.7 28.6-3.4.1 3.2-1.2c9.5-4 10.7-6.2 10-7.9-.7-1.7-3.1-2.3-12.7 1.7l-2.5 1.1 2-2c7.3-7.2 7.7-9.7 6.3-11-1.3-1.3-3.8-1-11 6.3a57 57 0 0 0-2.4 2.5l1.4-3.1C46.5 5.5 45.8 3 44 2.4c-1.7-.7-3.9.5-7.8 10.1l-1 2.6v-2.8C35.4 2 34 0 32 0s-3.4 2-3.4 12.3l.1 3.4-1.2-3.2c-4-9.5-6.2-10.7-7.9-10-1.7.7-2.3 3.1 1.7 12.7l1.1 2.5-2-2c-7.2-7.3-9.7-7.7-11-6.3-1.4 1.3-1 3.8 6.3 11a57 57 0 0 0 2.5 2.4L15 21.4C5.5 17.5 3 18.2 2.4 20c-.7 1.7.5 3.9 10.1 7.8l2.6 1h-2.8C2 28.6 0 30 0 32s2 3.4 12.3 3.4l3.4-.1-3.2 1.2c-9.5 4-10.7 6.2-10 7.9.7 1.7 3.1 2.3 12.7-1.7l2.5-1.1-2 2c-7.3 7.2-7.7 9.7-6.3 11 1.3 1.4 3.8 1 11-6.3l2.3-2.3-1.3 3c-3.9 9.5-3.2 12-1.5 12.6 1.7.7 3.9-.6 7.8-10.1l1-2.7v2.9C28.6 62 30 64 32 64s3.4-2 3.4-12.3l-.1-3.2 1.2 3c4 9.5 6.2 10.7 7.9 10 1.7-.7 2.3-3.2-1.7-12.7l-1.1-2.5 2 2c7.2 7.3 9.7 7.6 11 6.3 1.3-1.3 1-3.8-6.3-11a57 57 0 0 0-2.5-2.4l3.1 1.4c9.6 3.9 12 3.2 12.7 1.5.7-1.7-.6-3.9-10.1-7.8l-2.6-1h2.8C62 35.4 64 34 64 32s-2-3.4-12.3-3.4" />
            </svg>
            <span><?php echo esc_html( $category['title'] ); ?></span>
        </a>
        <?php endforeach; ?>
    </div>


    <br> <br>
    <div class="mx-auto mb-8 max-w-xl md:mb-24">

        <?php if ( is_user_logged_in() ) : ?>

        <a class="button w-full border"
            href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>">you are in, start exploring!</a>

        <?php else : ?>

        <?php if ( 'lostpassword' === $action ) : ?>

        <form class="mt-4 grid gap-4" method="post"
            data-ajax="<?php echo esc_url( admin_url( 'admin-ajax.php?action=lostpassword_form' ) ); ?>">
            <?php wp_nonce_field( 'lostpassword_action', 'lostpassword_nonce' ); ?>
            <input class="input-text" type="text" name="username" placeholder="Username *" required autofocus />
            <div class="text-lg">
                <a class="text-orange-500 hover:underline"
                    href="<?php echo esc_url( home_url( '/?action=signin' ) ); ?>">← go to sign in</a>
            </div>
            <button class="button bg-white text-neutral-800">get new password</button>
            <div class="alert"></div>
        </form>

        <?php else : ?>

        <div class="grid grid-cols-2 gap-4">

            <a class="button <?php echo esc_attr( 'signin' === $action ? 'bg-violet-700' : 'border' ); ?>"
                href="<?php echo esc_url( home_url( '/?action=signin' ) ); ?>">sign in</a>
            <a class="button <?php echo esc_attr( 'signup' === $action ? 'bg-violet-700' : 'border' ); ?>"
                href="<?php echo get_permalink(46); ?>">sign up</a>
        </div>

        <?php if ( 'signin' === $action ) : ?>
        <form class="mt-4 grid gap-4" method="post"
            data-ajax="<?php echo esc_url( admin_url( 'admin-ajax.php?action=signin_form' ) ); ?>">
            <?php wp_nonce_field( 'signin_action', 'signin_nonce' ); ?>
            <input class="input-text" type="text" name="username" placeholder="Username *" required autofocus />
            <input class="input-text" type="password" name="password" placeholder="Password *" required />
            <div class="text-lg">
                <a class="text-orange-500 hover:underline"
                    href="<?php echo esc_url( home_url( '/?action=lostpassword' ) ); ?>">Forgot password?</a>
            </div>
            <button class="button bg-white text-neutral-800">enter</button>
            <div class="alert"></div>
        </form>
        <?php endif; ?>

        <?php if ( 'signup' === $action ) : ?>
        <form class="mt-4 grid gap-4" method="post"
            data-ajax="<?php echo esc_url( admin_url( 'admin-ajax.php?action=signup_form' ) ); ?>">
            <?php wp_nonce_field( 'signup_action', 'signup_nonce' ); ?>
            <input class="input-text" type="email" name="email" placeholder="email *" required autofocus />
            <input class="input-text" type="text" name="username" placeholder="username *" required />
            <input class="input-text" type="password" name="password" placeholder="password *" required />
            <input class="input-text" type="text" name="company" placeholder="company/organization *" required />
            <input class="input-text" type="text" name="country" placeholder="country *" required />
            <div class="text-center text-lg">choose membership.</div>
            <div class="grid grid-cols-3 gap-4">
                <?php foreach ( array( 'basic explorer', 'solo explorer', 'Team explorers' ) as $key => $item ) : ?>
                <label class="relative">
                    <input class="peer absolute bottom-0 left-0 w-full opacity-0" type="radio" name="plan"
                        value="<?php echo esc_attr( $item ); ?>"
                        <?php echo esc_attr( 0 === $key && 'free' === $plan ? 'checked' : '' ); ?>
                        <?php echo esc_attr( 1 === $key && 'solo' === $plan ? 'checked' : '' ); ?>
                        <?php echo esc_attr( 2 === $key && 'team' === $plan ? 'checked' : '' ); ?>
                        <?php echo esc_attr( 0 === $key ? 'required' : '' ); ?> />
                    <span
                        class="button relative w-full border px-1 text-base font-normal leading-none peer-checked:border-none peer-checked:bg-orange-500"><?php echo esc_html( $item ); ?></span>
                </label>
                <?php endforeach; ?>
            </div>
            <div class="text-center text-lg">
                <a class="text-orange-500 hover:underline" href="<?php the_permalink( 46 ); ?>">see all the features and
                    prices</a>
            </div>
            <button class="button bg-white text-neutral-800">sign up</button>
            <div class="alert"></div>
        </form>
        <?php endif; ?>

        <?php endif; ?>

        <?php endif; ?>

    </div>


</main>

<?php
get_footer();