<?php
/**
 * Borra las opciones del plugin al desinstalarlo.
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
delete_option( 'fes_default_region' );
delete_option( 'fes_show_credit' );
