<?php

namespace GPS\Setup;
/**
 * Add tweaks to Advanced Custom Fields configuration
 */


/**
 * ACF Styling
 *
 * Updates some of the styling for Advanced Custom Fields in the editor
 * to make it a little easier to comprehend.
 */
function acf_styling() {
	echo '
		<style>
			.acf-flexible-content .layout:nth-child(even),
			.acf-field-setting-fc_layout:nth-child(even) td{
				background-color:rgba(0,0,0,.05) !important;
			} 
            .acf-flexible-content .layout:nth-child(even) .acf-th{
                background-color:rgba(0,0,0,.1);
            }
            .acf-flexible-content .layout:nth-child(even) .acf-button{
                background-color: rgba(0,0,0,.5);
                border-color: rgba(0,0,0,.5);
                box-shadow: none !important;
                text-shadow: none !important;
                color: #fff;
            }
            .acf-flexible-content .layout:nth-child(even) .acf-button:hover{
                box-shadow: 0 1px 0 rgba(0,0,0,.3) !important;
                text-shadow: 0 -1px 1px rgba(0,0,0,.3),1px 0 1px rgba(0,0,0,.3),0 1px 1px rgba(0,0,0,.3),-1px 0 1px rgba(0,0,0,.3) !important;
            }
            .acf-flexible-content .layout:nth-child(even) .acf-fc-layout-handle{
                background-color: rgba(0,0,0,0.3);
            }
			.acf-flexible-content .layout:nth-child(odd),
			.acf-field-setting-fc_layout:nth-child(odd) td{
				background-color:rgba(0, 115, 170, .05) !important;
			}
            .acf-flexible-content .layout:nth-child(odd) .acf-hl,
            .acf-flexible-content .layout:nth-child(odd) .acf-th{
                background-color:rgba(0, 115, 170, .1);
            }
            .acf-flexible-content .layout:nth-child(odd) .acf-fc-layout-handle{
                background-color: rgba(0, 115, 170, .3);
            }
            .acf-field-textarea[data-name="code"]{
                font-family: Courier, serif;
            }
        
		</style>
	';
}

add_action( 'admin_head', __NAMESPACE__ . '\\acf_styling' );


/**
 * Configure color palette on color picker
 * @see https://www.kristinfalkner.com/add-custom-color-palette-acf-pro-color-picker-field/
 */
function acf_input_admin_footer() { ?>
	<script type="text/javascript">
        (function($) {
            acf.add_filter('color_picker_args', function( args, $field ){
                // add the hexadecimal codes here for the colors you want to appear as swatches
                args.palettes = ['#ffffff', '#c1c1c1', '#4c4c4c', '#343434', '#cc9e52', '#e17000', '#c10b24', '#00a9e0', '#283590', '#92d400'];
                // return colors
                return args;
            });
        })(jQuery);
	</script>
<?php }
add_action('acf/input/admin_footer', __NAMESPACE__ . '\\acf_input_admin_footer');