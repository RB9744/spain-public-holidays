<?php
/**
 * Plugin Name:       Festivos España
 * Plugin URI:        https://sueldoclaro.es/calendario-laboral-2027/
 * Description:       Festivos de España 2027 (BOE y 17 comunidades) por shortcode: tabla, próximo festivo y ¿hoy es festivo? Sin llamadas externas.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            SueldoClaro
 * Author URI:        https://sueldoclaro.es/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       festivos-espana
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FES_VERSION', '1.0.0' );
define( 'FES_PATH', plugin_dir_path( __FILE__ ) );
define( 'FES_URL', plugin_dir_url( __FILE__ ) );

require_once FES_PATH . 'data-2027.php';

/**
 * Años disponibles en el plugin.
 *
 * @return int[]
 */
function fes_years() {
	return array( 2027 );
}

/**
 * Devuelve el conjunto de datos de un año o null si no existe.
 *
 * @param int $year Año.
 * @return array|null
 */
function fes_dataset( $year ) {
	$year = (int) $year;
	if ( 2027 === $year ) {
		return fes_data_2027();
	}
	return null;
}

/**
 * Lista de regiones (código => nombre) del año indicado.
 *
 * @param int $year Año.
 * @return array
 */
function fes_regions( $year = 2027 ) {
	$d = fes_dataset( $year );
	if ( ! $d ) {
		return array();
	}
	$out = array();
	foreach ( $d['regions'] as $code => $r ) {
		$out[ $code ] = $r['name'];
	}
	return $out;
}

/**
 * Normaliza el código de región que llega del shortcode o de los ajustes.
 * Acepta "ES-MD", "md", "madrid", "Comunidad de Madrid" (con o sin acentos).
 *
 * @param string $region Texto.
 * @param int    $year   Año.
 * @return string Código ISO (ES-XX) o cadena vacía para "solo nacionales".
 */
function fes_normalize_region( $region, $year = 2027 ) {
	$region = trim( (string) $region );
	if ( '' === $region || 'ES' === strtoupper( $region ) || 'nacional' === strtolower( $region ) ) {
		return '';
	}
	$regions = fes_regions( $year );
	$up      = strtoupper( $region );
	if ( isset( $regions[ $up ] ) ) {
		return $up;
	}
	if ( isset( $regions[ 'ES-' . $up ] ) ) {
		return 'ES-' . $up;
	}
	$needle = fes_fold( $region );
	if ( '' === $needle ) {
		return '';
	}
	foreach ( $regions as $code => $name ) {
		$hay = fes_fold( $name );
		if ( $hay === $needle || false !== strpos( $hay, $needle ) ) {
			return $code;
		}
	}
	$aliases = array(
		'valencia'  => 'ES-VC',
		'baleares'  => 'ES-IB',
		'balears'   => 'ES-IB',
		'mallorca'  => 'ES-IB',
		'euskadi'   => 'ES-PV',
		'vasco'     => 'ES-PV',
		'rioja'     => 'ES-RI',
		'mancha'    => 'ES-CM',
		'leon'      => 'ES-CL',
		'murcia'    => 'ES-MC',
		'navarra'   => 'ES-NC',
		'nafarroa'  => 'ES-NC',
		'asturias'  => 'ES-AS',
		'catalunya' => 'ES-CT',
	);
	foreach ( $aliases as $alias => $code ) {
		if ( false !== strpos( $needle, $alias ) && isset( $regions[ $code ] ) ) {
			return $code;
		}
	}
	return '';
}

/**
 * Minúsculas sin acentos para comparar nombres.
 *
 * @param string $s Texto.
 * @return string
 */
function fes_fold( $s ) {
	$s = remove_accents( $s );
	$s = strtolower( $s );
	return preg_replace( '/[^a-z0-9]/', '', $s );
}

/**
 * Festivos de una región (nacionales + autonómicos), ordenados por fecha.
 *
 * @param string $code Código ISO o vacío para nacionales.
 * @param int    $year Año.
 * @return array Cada elemento: array( 'date' => 'Y-m-d', 'name' => '...', 'scope' => 'nacional|autonómico' ).
 */
function fes_holidays( $code = '', $year = 2027 ) {
	$d = fes_dataset( $year );
	if ( ! $d ) {
		return array();
	}
	$list = array();
	foreach ( $d['national'] as $h ) {
		$list[] = array(
			'date'  => $h[0],
			'name'  => $h[1],
			'scope' => 'nacional',
		);
	}
	if ( '' !== $code && isset( $d['regions'][ $code ] ) ) {
		foreach ( $d['regions'][ $code ]['regional'] as $h ) {
			$list[] = array(
				'date'  => $h[0],
				'name'  => $h[1],
				'scope' => 'autonómico',
			);
		}
	}
	usort(
		$list,
		function ( $a, $b ) {
			return strcmp( $a['date'], $b['date'] );
		}
	);
	return $list;
}

/**
 * Fuente oficial de una región, o la nacional si el código está vacío.
 *
 * @param string $code Código ISO.
 * @param int    $year Año.
 * @return array array( etiqueta, url )
 */
function fes_source( $code = '', $year = 2027 ) {
	$d = fes_dataset( $year );
	if ( ! $d ) {
		return array( '', '' );
	}
	if ( '' !== $code && isset( $d['regions'][ $code ] ) ) {
		return $d['regions'][ $code ]['source'];
	}
	return $d['national_source'];
}

/**
 * Fecha de hoy en la zona horaria del sitio (Y-m-d).
 *
 * @return string
 */
function fes_today() {
	return wp_date( 'Y-m-d' );
}

/**
 * Formatea una fecha Y-m-d con el formato de fecha del sitio y el día de la semana.
 *
 * @param string $ymd Fecha.
 * @return string
 */
function fes_format_date( $ymd ) {
	$ts = strtotime( $ymd . ' 12:00:00' );
	return wp_date( 'l j \d\e F', $ts );
}

/**
 * Región por defecto guardada en ajustes.
 *
 * @return string
 */
function fes_default_region() {
	return fes_normalize_region( get_option( 'fes_default_region', '' ) );
}

/**
 * Atributos comunes de los shortcodes.
 *
 * @param array $atts Atributos.
 * @return array array( code, year, nombre región )
 */
function fes_common_atts( $atts ) {
	$atts = shortcode_atts(
		array(
			'region' => '',
			'year'   => '2027',
		),
		$atts
	);
	$year = (int) $atts['year'];
	if ( ! in_array( $year, fes_years(), true ) ) {
		$year = 2027;
	}
	$code = '' !== $atts['region'] ? fes_normalize_region( $atts['region'], $year ) : fes_default_region();
	$name = '' !== $code ? fes_regions( $year )[ $code ] : __( 'España (festivos nacionales)', 'festivos-espana' );
	return array( $code, $year, $name );
}

/**
 * Enlace de crédito opcional (desactivado por defecto).
 *
 * @return string HTML o cadena vacía.
 */
function fes_credit() {
	if ( '1' !== get_option( 'fes_show_credit', '0' ) ) {
		return '';
	}
	return '<p class="fes-credit">' . sprintf(
		/* translators: %s: enlace a SueldoClaro */
		esc_html__( 'Datos: %s', 'festivos-espana' ),
		'<a href="https://sueldoclaro.es/calendario-laboral-2027/" rel="noopener">SueldoClaro</a>'
	) . '</p>';
}

/**
 * Shortcode [festivos region="ES-MD" year="2027" fuente="1"]: tabla de festivos.
 *
 * @param array $atts Atributos.
 * @return string
 */
function fes_shortcode_table( $atts ) {
	list( $code, $year, $name ) = fes_common_atts( $atts );
	$atts  = shortcode_atts( array( 'fuente' => '1' ), $atts );
	$rows  = fes_holidays( $code, $year );
	$today = fes_today();
	fes_enqueue();

	$html  = '<div class="fes-wrap">';
	$html .= '<table class="fes-table"><caption>' . sprintf(
		/* translators: 1: región, 2: año */
		esc_html__( 'Festivos %1$s %2$d', 'festivos-espana' ),
		esc_html( $name ),
		(int) $year
	) . '</caption>';
	$html .= '<thead><tr><th>' . esc_html__( 'Fecha', 'festivos-espana' ) . '</th><th>' . esc_html__( 'Festivo', 'festivos-espana' ) . '</th><th>' . esc_html__( 'Ámbito', 'festivos-espana' ) . '</th></tr></thead><tbody>';
	foreach ( $rows as $h ) {
		$cls   = $h['date'] < $today ? ' fes-past' : ( $h['date'] === $today ? ' fes-today' : '' );
		$html .= '<tr class="fes-row' . esc_attr( $cls ) . '">';
		$html .= '<td><time datetime="' . esc_attr( $h['date'] ) . '">' . esc_html( fes_format_date( $h['date'] ) ) . '</time></td>';
		$html .= '<td>' . esc_html( $h['name'] ) . '</td>';
		$html .= '<td>' . esc_html( $h['scope'] ) . '</td></tr>';
	}
	$html .= '</tbody></table>';
	if ( '1' === (string) $atts['fuente'] ) {
		$src = fes_source( $code, $year );
		if ( ! empty( $src[1] ) ) {
			$html .= '<p class="fes-source">' . esc_html__( 'Fuente oficial:', 'festivos-espana' ) . ' <a href="' . esc_url( $src[1] ) . '" rel="noopener">' . esc_html( $src[0] ) . '</a></p>';
		}
	}
	$html .= fes_credit();
	$html .= '</div>';
	return $html;
}
add_shortcode( 'festivos', 'fes_shortcode_table' );

/**
 * Shortcode [festivos_proximo region="ES-CT"]: próximo festivo y días que faltan.
 *
 * @param array $atts Atributos.
 * @return string
 */
function fes_shortcode_next( $atts ) {
	list( $code, $year, $name ) = fes_common_atts( $atts );
	$today = fes_today();
	$next  = null;
	foreach ( fes_holidays( $code, $year ) as $h ) {
		if ( $h['date'] >= $today ) {
			$next = $h;
			break;
		}
	}
	fes_enqueue();
	if ( ! $next ) {
		return '<p class="fes-next">' . sprintf(
			/* translators: 1: región, 2: año */
			esc_html__( 'No quedan festivos de %1$d en %2$s.', 'festivos-espana' ),
			(int) $year,
			esc_html( $name )
		) . '</p>';
	}
	$days = (int) round( ( strtotime( $next['date'] ) - strtotime( $today ) ) / DAY_IN_SECONDS );
	if ( 0 === $days ) {
		$when = __( 'es hoy', 'festivos-espana' );
	} elseif ( 1 === $days ) {
		$when = __( 'es mañana', 'festivos-espana' );
	} else {
		/* translators: %d: número de días */
		$when = sprintf( __( 'faltan %d días', 'festivos-espana' ), $days );
	}
	return '<p class="fes-next">' . sprintf(
		/* translators: 1: región, 2: nombre del festivo, 3: fecha, 4: "faltan N días" */
		esc_html__( 'Próximo festivo en %1$s: %2$s, %3$s (%4$s).', 'festivos-espana' ),
		esc_html( $name ),
		'<strong>' . esc_html( $next['name'] ) . '</strong>',
		esc_html( fes_format_date( $next['date'] ) ),
		esc_html( $when )
	) . '</p>' . fes_credit();
}
add_shortcode( 'festivos_proximo', 'fes_shortcode_next' );

/**
 * Shortcode [festivos_hoy region="ES-AN"]: ¿hoy es festivo?
 *
 * @param array $atts Atributos.
 * @return string
 */
function fes_shortcode_today( $atts ) {
	list( $code, $year, $name ) = fes_common_atts( $atts );
	$today = fes_today();
	fes_enqueue();
	foreach ( fes_holidays( $code, $year ) as $h ) {
		if ( $h['date'] === $today ) {
			return '<p class="fes-today-msg fes-yes">' . sprintf(
				/* translators: 1: nombre del festivo, 2: región */
				esc_html__( 'Sí, hoy es festivo: %1$s (%2$s).', 'festivos-espana' ),
				esc_html( $h['name'] ),
				esc_html( $name )
			) . '</p>' . fes_credit();
		}
	}
	return '<p class="fes-today-msg fes-no">' . sprintf(
		/* translators: %s: región */
		esc_html__( 'Hoy no es festivo en %s.', 'festivos-espana' ),
		esc_html( $name )
	) . '</p>' . fes_credit();
}
add_shortcode( 'festivos_hoy', 'fes_shortcode_today' );

/**
 * CSS mínimo, solo cuando se usa un shortcode.
 */
function fes_enqueue() {
	wp_register_style( 'festivos-espana', FES_URL . 'festivos-espana.css', array(), FES_VERSION );
	wp_enqueue_style( 'festivos-espana' );
}

/* ---------- Ajustes ---------- */

function fes_register_settings() {
	register_setting(
		'fes_settings',
		'fes_default_region',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'fes_sanitize_region',
			'default'           => '',
		)
	);
	register_setting(
		'fes_settings',
		'fes_show_credit',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'fes_sanitize_checkbox',
			'default'           => '0',
		)
	);
}
add_action( 'admin_init', 'fes_register_settings' );

function fes_sanitize_region( $v ) {
	return fes_normalize_region( sanitize_text_field( (string) $v ) );
}

function fes_sanitize_checkbox( $v ) {
	return '1' === (string) $v ? '1' : '0';
}

function fes_admin_menu() {
	add_options_page(
		__( 'Festivos España', 'festivos-espana' ),
		__( 'Festivos España', 'festivos-espana' ),
		'manage_options',
		'festivos-espana',
		'fes_settings_page'
	);
}
add_action( 'admin_menu', 'fes_admin_menu' );

function fes_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$current = get_option( 'fes_default_region', '' );
	$credit  = get_option( 'fes_show_credit', '0' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Festivos España', 'festivos-espana' ); ?></h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'fes_settings' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="fes_default_region"><?php esc_html_e( 'Comunidad autónoma por defecto', 'festivos-espana' ); ?></label></th>
					<td>
						<select name="fes_default_region" id="fes_default_region">
							<option value=""><?php esc_html_e( 'Solo festivos nacionales', 'festivos-espana' ); ?></option>
							<?php foreach ( fes_regions() as $code => $name ) : ?>
								<option value="<?php echo esc_attr( $code ); ?>" <?php selected( $current, $code ); ?>><?php echo esc_html( $name ); ?></option>
							<?php endforeach; ?>
						</select>
						<p class="description"><?php esc_html_e( 'Se usa cuando el shortcode no lleva el atributo region.', 'festivos-espana' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Enlace de crédito', 'festivos-espana' ); ?></th>
					<td>
						<label><input type="checkbox" name="fes_show_credit" value="1" <?php checked( $credit, '1' ); ?> /> <?php esc_html_e( 'Mostrar "Datos: SueldoClaro" debajo de cada shortcode (opcional, desactivado por defecto).', 'festivos-espana' ); ?></label>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
		<h2><?php esc_html_e( 'Shortcodes', 'festivos-espana' ); ?></h2>
		<ul>
			<li><code>[festivos region="ES-MD"]</code> <?php esc_html_e( 'tabla de festivos (añade fuente="0" para ocultar la fuente oficial)', 'festivos-espana' ); ?></li>
			<li><code>[festivos_proximo region="ES-CT"]</code> <?php esc_html_e( 'próximo festivo y días que faltan', 'festivos-espana' ); ?></li>
			<li><code>[festivos_hoy region="ES-AN"]</code> <?php esc_html_e( '¿hoy es festivo?', 'festivos-espana' ); ?></li>
		</ul>
		<p><?php esc_html_e( 'Códigos de región:', 'festivos-espana' ); ?> <?php echo esc_html( implode( ', ', array_keys( fes_regions() ) ) ); ?>. <?php esc_html_e( 'También valen los nombres (madrid, cataluña, pais vasco...).', 'festivos-espana' ); ?></p>
	</div>
	<?php
}

/**
 * Enlace "Ajustes" en la lista de plugins.
 */
function fes_action_links( $links ) {
	$links[] = '<a href="' . esc_url( admin_url( 'options-general.php?page=festivos-espana' ) ) . '">' . esc_html__( 'Ajustes', 'festivos-espana' ) . '</a>';
	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'fes_action_links' );
