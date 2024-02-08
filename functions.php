<?php
/**
 * Functions
 *
 * @package WordPress
 */

/**
 * GENERAL SETTINGS
 * ***************************************************************************************************
 */
add_action(
	'after_setup_theme',
	function() {
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'style', 'script' ) );
		// add_theme_support( 'post-thumbnails', array( 'post' ) );
		add_theme_support('woocommerce');
		add_theme_support( 'post-formats', array( 'audio', 'link', 'status', 'video' ) );
		register_nav_menu( 'header', 'Header' );
		register_nav_menu( 'footer1', 'Footer 1' );
		register_nav_menu( 'footer2', 'Footer 2' );
	},
	11,
);

/**
 * SCRIPTS & STYLES
 * ***************************************************************************************************
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_deregister_style( 'global-styles' );
		wp_deregister_style( 'classic-theme-styles' );
		wp_deregister_style( 'wp-block-library' );
		wp_enqueue_style( 'bundle', get_theme_file_uri( 'bundle.css' ), array(), '1.0.1' );
		wp_enqueue_script( 'bundle', get_theme_file_uri( 'bundle.js' ), array(), '1.0.1', true );
	}
);

/**
 * FILTERS
 * ***************************************************************************************************
 */
add_filter( 'show_admin_bar', '__return_false' );
add_filter( 'use_block_editor_for_post', '__return_false' );

/**
 * AJAX
 * ***************************************************************************************************
 */
function signup_form() {
	check_ajax_referer( 'signup_action', 'signup_nonce' );
	$email    = sanitize_text_field( $_POST['email'] ?? '' );
	$username = sanitize_text_field( $_POST['username'] ?? '' );
	$password = sanitize_text_field( $_POST['password'] ?? '' );
	$company  = sanitize_text_field( $_POST['company'] ?? '' );
	$country  = sanitize_text_field( $_POST['country'] ?? '' );
	$plan     = sanitize_text_field( $_POST['plan'] ?? '' );
	$message  = '';
	$message .= $email ? '<p><strong>Email:</strong> ' . $email . '</p>' : '';
	$message .= $username ? '<p><strong>Username:</strong> ' . $username . '</p>' : '';
	$message .= $password ? '<p><strong>Password:</strong> ' . $password . '</p>' : '';
	$message .= $company ? '<p><strong>Company:</strong> ' . $company . '</p>' : '';
	$message .= $country ? '<p><strong>Country:</strong> ' . $country . '</p>' : '';
	$message .= $plan ? '<p><strong>Plan:</strong> ' . $plan . '</p>' : '';
	$headers  = 'MIME-Version:1.0' . "\r\n";
	$headers .= 'Content-type:text/html;charset=utf-8' . "\r\n";
	$headers .= 'From:noreplay@larger.world' . "\r\n";
	$headers .= 'Reply-To:' . $email . "\r\n";
	$send     = wp_mail( 'marc@mhou.es, guillermo@maurin.studio', 'New form message.', $message, $headers );
	if ( $send ) {
		wp_send_json_success( 'Thank you, your message has been sent successfully.' );
	}
	wp_send_json_error( 'Something went wrong, please try again.' );
}
add_action( 'wp_ajax_nopriv_signup_form', 'signup_form' );
add_action( 'wp_ajax_signup_form', 'signup_form' );

function signin_form() {
	check_ajax_referer( 'signin_action', 'signin_nonce' );
	$creds = array(
		'user_login'    => sanitize_text_field( $_POST['username'] ?? '' ),
		'user_password' => sanitize_text_field( $_POST['password'] ?? '' ),
		'remember'      => true,
	);
	$user = wp_signon( $creds, is_ssl() );
	if ( is_wp_error( $user ) ) {
		wp_send_json_error( $user->get_error_message() );
	}
	wp_send_json_success( 'reload' );
}
add_action( 'wp_ajax_nopriv_signin_form', 'signin_form' );
add_action( 'wp_ajax_signin_form', 'signin_form' );

function lostpassword_form() {
	check_ajax_referer( 'lostpassword_action', 'lostpassword_nonce' );
	$user = retrieve_password( sanitize_text_field( $_POST['username'] ?? '' ) );
	if ( is_wp_error( $user ) ) {
		wp_send_json_error( $user->get_error_message() );
	}
	wp_send_json_success( 'ok' );
}
add_action( 'wp_ajax_nopriv_lostpassword_form', 'lostpassword_form' );
add_action( 'wp_ajax_lostpassword_form', 'lostpassword_form' );

/**
 * ACTION
 * ***************************************************************************************************
 */
add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( ! is_admin() && $query->is_main_query() ) {
			$map_types = array(
				'article'  => array( 'taxonomy' => 'post_format', 'operator' => 'NOT EXISTS' ),
				'document' => array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array( 'post-format-link' ) ),
				'event'    => array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array( 'post-format-status' ) ),
				'podcast'  => array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array( 'post-format-audio' ) ),
				'video'    => array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array( 'post-format-video' ) ),
			);
			$type   = $_GET['type'] ?? null;
			$impact = $_GET['impact'] ?? null;
			$args = array();
			if ( $type ) {
				$args[] = $map_types[ $type ];
			}
			if ( $impact ) {
				$args[] = array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => array( $impact ) );
			}
			$query->set( 'tax_query', $args );
		}
	},
);

/**
 * ROLES
 * ***************************************************************************************************
 */
// add_role( 'team', 'Plan team premium' );
// add_role( 'solo', 'Plan solo premium' );
// add_role( 'free', 'Plan free forever' );
// remove_role( 'team' );
// remove_role( 'solo' );
// remove_role( 'free' );



function redirect_to_checkout_if_buy_param() {
    if ( isset( $_GET['buy'] ) ) {
        $product_id = false;

        // Aquí debes convertir el shortcode a ID de producto. Esto es solo un ejemplo.
        switch ( $_GET['buy'] ) {
            case 'basic-explorer':
                $product_id = 294; // ID del producto para "basic explorer"
                break;
            case 'solo-explorer':
                $product_id = 295; // ID del producto para "solo explorer"
                break;
            case 'team-explorers':
                $product_id = 296; // ID del producto para "team explorers"
                break;
        }

        if ( $product_id ) {
            WC()->cart->empty_cart(); // Vacía el carrito antes de añadir un nuevo producto
            WC()->cart->add_to_cart( $product_id );
            wp_safe_redirect( wc_get_checkout_url() );
            exit;
        }
    }
}
add_action( 'template_redirect', 'redirect_to_checkout_if_buy_param' );



function add_custom_class_to_checkout_button() {
    ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
    // Asegúrate de que este código se ejecute solo en la página de checkout
    if ($('body').hasClass('woocommerce-checkout')) {
        // Añade la clase 'border' a los botones dentro de '.wc-block-checkout__actions-row'
        $('.wc-block-checkout__actions-row button').addClass('border');
    }
});
</script>
<?php
}
add_action( 'wp_footer', 'add_custom_class_to_checkout_button' );



function hide_return_to_cart_button_css() {
    if ( is_checkout() ) {
        echo '<style>.wc-block-components-checkout-return-to-cart-button{display: none !important;}</style>';
    }
}
add_action( 'wp_head', 'hide_return_to_cart_button_css' );


function theme_scripts() {
    echo "<script>
    jQuery(document).ready(function($) {
        $('#hamburger').click(function() {
            $(this).toggleClass('open');
            // Controlar la animación de las líneas del hamburguesa
            $('.hamburger-line').eq(1).toggleClass('opacity-0'); // Ocultar el del medio
            $('.hamburger-line').eq(0).toggleClass('-rotate-45 origin-right'); // Girar el primero
            $('.hamburger-line').eq(2).toggleClass('rotate-45 origin-right'); // Girar el último

            // Añadir o quitar clases para mostrar/ocultar el menú lateral
            $('#menu').toggleClass('translate-x-full translate-x-0');
			$('#menu').toggleClass('hidden flex');

            // Desactivar/Activar el desplazamiento del cuerpo de la página
            $('body').toggleClass('overflow-hidden');
        });
    });
    </script>";
}
add_action('wp_head', 'theme_scripts');


// Función para cambiar el mensaje de correo electrónico de restablecimiento de contraseña
function custom_reset_password_message( $message, $key, $user_login, $user_data ) {
    $message = 'Hello ' . $user_login . ",<br><br>";
$message .= 'It seems like you need to reset your password. No problem! Use the following link:<br><br>';
$message .= network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login' );
$message .= "<br><br>If you did not request this, please ignore this email.<br><br>";
$message .= 'Best wishes,<br>';
$message .= 'Larger.world team<br>';


    return $message;
}
add_filter( 'retrieve_password_message', 'custom_reset_password_message', 10, 4 );

function set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type', 'set_content_type' );


add_filter('wp_mail_from_name', function($name) {
    return 'larger.world';
});

add_filter('wp_mail_from', function($email) {
    return 'no-reply@larger.world'; // Reemplaza con la dirección de correo electrónico deseada
});


add_action( 'woocommerce_thankyou', 'custom_thankyou_message' );

function custom_thankyou_message( $order_id ) {
    if ( ! $order_id )
        return;

    // Asegúrate de que es la página correcta
    if ( is_wc_endpoint_url( 'order-received' ) ) {

        // Aquí escribe tu mensaje personalizado
        echo '<div class="my-12 flex justify-center py-8">';
		echo '<img src="'.get_template_directory_uri().'/assets/img/man.png" />';
		 echo '</div>';
    }
}

function custom_subscription_thank_you_message( $thank_you_message, $order_id ) {
    // HTML personalizado que deseas añadir
    $custom_html = "<span style='font-weight: bold;'>let us know</span> if you have further questions.";

    
    $thank_you_message = $custom_html ;

    // Devolver el mensaje modificado con HTML
    return $thank_you_message;
}
add_filter( 'woocommerce_subscriptions_thank_you_message', 'custom_subscription_thank_you_message', 10, 2 );




//Form




add_action('init', 'handle_form_submission');

function handle_form_submission() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
        $email = sanitize_email($_POST['email']);
        // Lógica para manejar el email

        // Establecer una cookie
        setcookie("formulario_enviado", "1", time() + (86400 * 30), "/");

        // Redirigir a la URL proporcionada
        if (isset($_POST['redirect_url'])) {
            $redirect_url = esc_url_raw($_POST['redirect_url']);
            wp_redirect($redirect_url);
            exit;
        }
    }
}





function suscripcion_form_shortcode() {
    if(!isset($_COOKIE['formulario_enviado'])) {
        ob_start();
        ?>


<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" class="space-y-6">

    <input type="hidden" name="redirect_url" value="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
    <div>
        <label for="email" class="block text-sm font-medium mb-2">Your email:</label>
        <input type="email" id="email" name="email" required
            class="w-full px-4 py-2 bg-white rounded border border-transparent focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent text-gray-900"
            placeholder="Enter your email">
    </div>


    <button type="submit"
        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded">Subscribe</button>


    <p class="text-center text-sm">
        Already a member?
        <a href="LINK_A_TU_LOGIN" class="text-blue-200 hover:text-blue-100">Sign in</a>
    </p>

    <p class="text-center text-sm">
        To see our premium memberships,
        <a href="LINK_A_TU_LOGIN" class="text-blue-200 hover:text-blue-100">Sign in</a>
    </p>
</form>

<?php
        return ob_get_clean();
    } else {
        return 'Gracias por suscribirte.';
    }
}

add_shortcode('suscripcion_form', 'suscripcion_form_shortcode');