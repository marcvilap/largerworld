<?php
/**
 * Page
 *
 * @package WordPress
 */

$plans = array(
	array(
		'name'     => 'basic explorer',
		'features' => array( 'Access to free content', 'Access to newsletter', 'Live events' ),
		'price'    => '0€',
		'button'   => 'Go free',
		'shortcode'=>'basic-explorer',
	),
	array(
		'name'     => 'solo explorer',
		'features' => array( 'Access to free content', 'Access to newsletter', 'Live events', 'Video content', 'Forum/community', 'Specilized tools' ),
		'price'    => '10€/monthly',
		'button'   => 'Go solo premium',
		'shortcode'=>'solo-explorer',
	),
	array(
		'name'     => 'team explorers',
		'features' => array( 'Access to free content', 'Access to newsletter', 'Live events', 'Video content', 'Forum/community', 'Specilized tools', '50+ users company package, with special perks (consulting hours, customized training and facilitation services)' ),
		'price'    => '500€/monthly',
		'button'   => 'Go team premium',
		'shortcode'=>'team-explorers',
	),
);

?>
<main class="container py-8 md:py-24">
    <h1 class="text-4xl lowercase">which type of explorer are you?</h1>
    <div class="my-8 max-w-[46rem] text-xl md:my-12 md:text-3xl">
        <p>there are different ways to explore our worlds, so take your time to estimate what membership works best for
            you at this point. no matter what membership you choose, we can’t wait to welcome you into our worlds.
            <br>
            any questions about our memberships? <a href="https://ver.pw/largerworld/contact">just ask!</a>
        </p>
    </div>
    <div class="grid items-start gap-x-6 gap-y-12 text-center lowercase md:grid-cols-3">
        <?php foreach ( $plans as $plan ) : ?>
        <div class="grid gap-3">
            <div class="bg-violet-500 p-4 text-white"><?php echo esc_html( $plan['name'] ); ?></div>
            <?php foreach ( $plan['features'] as $feature ) : ?>
            <div class="border border-current p-4"><?php echo esc_html( $feature ); ?></div>
            <?php endforeach; ?>
            <div class="bg-white p-4 text-neutral-800"><?php echo esc_html( $plan['price'] ); ?></div>
            <a class="button bg-orange-500"
                href="<?php echo esc_url( add_query_arg( 'buy', $plan['shortcode'], home_url() ) ); ?>">
                <?php echo esc_html( $plan['button'] ); ?>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</main>