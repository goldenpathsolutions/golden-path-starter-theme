<?php

namespace GPS\Setup;
/**
 * Configure things like Google Analytics, Tag Manager, or API
 *
 */


/**
 * Add Google Tag Manager
 *
 * Set the Google Tag Manager code, GTM_CODE,
 * in wp-config.php, and this will inject the snippet in the head section
 */
function add_google_analytics() {

	if ( defined('GTM_CODE') ) {
		?>
        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '<?php echo GTM_CODE; ?>');</script>
        <!-- End Google Tag Manager -->
		<?php
	}
}

add_action( 'wp_head', __NAMESPACE__ . '\\add_google_analytics', 44 );
