<?php

namespace GPS\Setup;
/**
 * Configure things like Google Analytics, Tag Manager, or API
 *
 */


/**
 * Add Google Analytics
 *
 * Set the Google Analytics tracking code, GA_TRACKING_CODE,
 * in wp-config.php, and this will inject the snippet in the head section
 */
function add_googleanalytics() {

	if ( GA_TRACKING_CODE ) {
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
            })(window, document, 'script', 'dataLayer', '<?php echo GA_TRACKING_CODE; ?>');</script>
        <!-- End Google Tag Manager -->
		<?php
	}
}

add_action( 'wp_head', array( __NAMESPACE__ . '\\wpb_add_googleanalytics' ), 44 );
