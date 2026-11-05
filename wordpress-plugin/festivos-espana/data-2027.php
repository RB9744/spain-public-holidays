<?php
/**
 * Datos de festivos 2027. Fuente: BOE-A-2026-21254 y boletines autonómicos (ver $fes_sources).
 * Generado a partir de https://github.com/RB9744/spain-public-holidays (CC BY 4.0).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function fes_data_2027() {
	return array(
		'national' => array(
			array( '2027-01-01', 'Año Nuevo' ),
			array( '2027-01-06', 'Epifanía del Señor' ),
			array( '2027-03-26', 'Viernes Santo' ),
			array( '2027-05-01', 'Fiesta del Trabajo' ),
			array( '2027-10-12', 'Fiesta Nacional de España' ),
			array( '2027-11-01', 'Todos los Santos' ),
			array( '2027-12-06', 'Día de la Constitución' ),
			array( '2027-12-08', 'Inmaculada Concepción' ),
			array( '2027-12-25', 'Navidad' ),
		),
		'regions' => array(
			'ES-AN' => array(
				'name' => 'Andalucía',
				'source' => array( 'Decreto 84/2026 de la Junta de Andalucía (BOJA nº 84, 5 de mayo de 2026)', 'https://www.juntadeandalucia.es/eboja/2026/84/BOJA26-084-00002-5812-01_00337048.pdf' ),
				'regional' => array(
					array( '2027-03-01', 'Lunes siguiente al Día de Andalucía' ),
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-08-16', 'Lunes siguiente a la Asunción' ),
				),
			),
			'ES-AR' => array(
				'name' => 'Aragón',
				'source' => array( 'Decreto 163/2026, de 9 de septiembre (BOA nº 180, 16 de septiembre de 2026)', 'https://www.boa.aragon.es/cgi-bin/EBOA/BRSCGI?CMD=VEROBJ&MLKOB=1466225130707' ),
				'regional' => array(
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-04-23', 'San Jorge, Día de Aragón' ),
					array( '2027-08-16', 'Lunes siguiente a la Asunción' ),
				),
			),
			'ES-AS' => array(
				'name' => 'Principado de Asturias',
				'source' => array( 'Decreto 7/2026, de 16 de febrero (BOPA, 26 de febrero de 2026)', 'https://miprincipado.asturias.es/bopa/2026/02/26/2026-01506.pdf' ),
				'regional' => array(
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-08-16', 'Lunes siguiente a la Asunción' ),
					array( '2027-09-08', 'Día de Asturias' ),
				),
			),
			'ES-IB' => array(
				'name' => 'Illes Balears',
				'source' => array( 'Resolución de la consellera de Treball, calendario laboral 2027 (BOIB nº 122, 29 de septiembre de 2026)', 'https://www.caib.es/webgoib/es/w/consell-de-governaprobado-el-calendario-de-fiestas-laborales-de-baleares-para-el-ano-2027' ),
				'regional' => array(
					array( '2027-03-01', 'Día de las Illes Balears' ),
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-03-29', 'Lunes de Pascua' ),
				),
			),
			'ES-CN' => array(
				'name' => 'Canarias',
				'source' => array( 'Decreto 115/2026, de 29 de junio (BOC nº 133, 3 de julio de 2026)', 'https://www.gobiernodecanarias.org/boc/2026/133/2334.html' ),
				'regional' => array(
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-05-30', 'Día de Canarias' ),
					array( '2027-08-16', 'Lunes siguiente a la Asunción' ),
				),
			),
			'ES-CB' => array(
				'name' => 'Cantabria',
				'source' => array( 'Orden de la Consejería de Industria de 6 de julio de 2026 (BOC, 15 de julio de 2026)', 'https://boc.cantabria.es/boces/verAnuncioAction.do?idAnuBlob=438006' ),
				'regional' => array(
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-07-28', 'Día de las Instituciones de Cantabria' ),
					array( '2027-09-15', 'La Bien Aparecida' ),
				),
			),
			'ES-CL' => array(
				'name' => 'Castilla y León',
				'source' => array( 'Decreto 7/2026 de la Junta de Castilla y León (BOCYL, 30 de marzo de 2026)', 'https://laadministracionaldia.inap.es/noticia.asp?id=1264437' ),
				'regional' => array(
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-04-23', 'Fiesta de la Comunidad (Villalar)' ),
					array( '2027-08-16', 'Lunes siguiente a la Asunción' ),
				),
			),
			'ES-CM' => array(
				'name' => 'Castilla-La Mancha',
				'source' => array( 'Decreto 34/2026, de 23 de junio (DOCM, 13 de julio de 2026)', 'https://laadministracionaldia.inap.es/noticia.asp?id=1267648' ),
				'regional' => array(
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-05-27', 'Corpus Christi' ),
					array( '2027-05-31', 'Día de Castilla-La Mancha' ),
				),
			),
			'ES-CT' => array(
				'name' => 'Cataluña',
				'source' => array( 'Ordre EMT/52/2026 de la Generalitat (DOGC núm. 9637, 1 de abril de 2026)', 'https://dogc.gencat.cat/ca/document-del-dogc/?documentId=1040896' ),
				'regional' => array(
					array( '2027-03-29', 'Lunes de Pascua' ),
					array( '2027-06-24', 'Sant Joan' ),
					array( '2027-09-11', 'Diada Nacional de Catalunya' ),
				),
			),
			'ES-EX' => array(
				'name' => 'Extremadura',
				'source' => array( 'Decreto 119/2026 de la Junta de Extremadura (DOE, 8 de junio de 2026)', 'https://laadministracionaldia.inap.es/noticia.asp?id=1266525' ),
				'regional' => array(
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-09-08', 'Día de Extremadura' ),
					array( '2027-10-11', 'Lunes de descanso por la Asunción' ),
				),
			),
			'ES-GA' => array(
				'name' => 'Galicia',
				'source' => array( 'Decreto 68/2026, de 15 de junio (DOG nº 122, 2 de julio de 2026)', 'https://www.xunta.gal/dog/Publicados/2026/20260702/AnuncioG0767-250626-0001_es.html' ),
				'regional' => array(
					array( '2027-03-19', 'San José' ),
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-05-17', 'Día de las Letras Gallegas' ),
				),
			),
			'ES-MD' => array(
				'name' => 'Comunidad de Madrid',
				'source' => array( 'Decreto 82/2026 de la Comunidad de Madrid (BOCM, 1 de octubre de 2026)', 'https://www.bocm.es/boletin/CM_Orden_BOCM/2026/10/01/BOCM-20261001-19.PDF' ),
				'regional' => array(
					array( '2027-03-19', 'San José' ),
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-08-16', 'Lunes siguiente a la Asunción' ),
				),
			),
			'ES-MC' => array(
				'name' => 'Región de Murcia',
				'source' => array( 'Resolución de 13 de julio de 2026, Dirección General de Trabajo (BORM nº 171, 27 de julio de 2026)', 'https://www.borm.es/services/anuncio/844400/pdf' ),
				'regional' => array(
					array( '2027-03-19', 'San José' ),
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-06-09', 'Día de la Región de Murcia' ),
				),
			),
			'ES-NC' => array(
				'name' => 'Navarra',
				'source' => array( 'Resolución 232/2026, de 13 de mayo (BON nº 103, 28 de mayo de 2026)', 'https://bon.navarra.es/es/anuncio/-/texto/2026/103/23' ),
				'regional' => array(
					array( '2027-03-19', 'San José' ),
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-03-29', 'Lunes de Pascua' ),
					array( '2027-12-03', 'San Francisco Javier, Día de Navarra' ),
				),
			),
			'ES-PV' => array(
				'name' => 'País Vasco',
				'source' => array( 'Decreto 90/2026 del Gobierno Vasco (BOPV nº 134, 16 de julio de 2026)', 'https://www.euskadi.eus/bopv2/datos/2026/07/2603215a.shtml' ),
				'regional' => array(
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-03-29', 'Lunes de Pascua' ),
					array( '2027-10-07', 'Aniversario del primer Gobierno Vasco' ),
				),
			),
			'ES-RI' => array(
				'name' => 'La Rioja',
				'source' => array( 'Decreto del Gobierno de La Rioja (BOR nº 86, 8 de mayo de 2026)', 'https://www.larioja.org/dialogo-laboral/es/calendario-festivos-laborales-2027' ),
				'regional' => array(
					array( '2027-03-25', 'Jueves Santo' ),
					array( '2027-03-29', 'Lunes de Pascua' ),
					array( '2027-06-09', 'Día de La Rioja' ),
				),
			),
			'ES-VC' => array(
				'name' => 'Comunitat Valenciana',
				'source' => array( 'Decreto 42/2026 del Consell (DOGV nº 10329, 25 de marzo de 2026)', 'https://comunica.gva.es/es/detalle?id=403512353&site=373431293' ),
				'regional' => array(
					array( '2027-03-19', 'San José' ),
					array( '2027-03-29', 'Lunes de Pascua' ),
					array( '2027-10-09', 'Día de la Comunitat Valenciana' ),
				),
			),
		),
		'national_source' => array( 'Resolución de 8 de octubre de 2026, Dirección General de Trabajo (BOE, 13 de octubre de 2026)', 'https://www.boe.es/diario_boe/txt.php?id=BOE-A-2026-21254' ),
	);
}
