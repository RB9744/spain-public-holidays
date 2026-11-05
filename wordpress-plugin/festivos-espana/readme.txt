=== Festivos España ===
Contributors: rb9744
Tags: festivos, calendario laboral, españa, holidays, spain
Requires at least: 6.0
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Festivos nacionales y autonómicos de España 2027 con tres shortcodes: tabla de festivos, próximo festivo y "¿hoy es festivo?". Sin llamadas externas.

== Description ==

Muestra en tu web los festivos oficiales de España para 2027: los 9 festivos nacionales del BOE más los autonómicos de las 17 comunidades, cada uno con el boletín oficial del que sale (BOE, BOA, BOC, BON, DOCM, DOGC, DOGV...).

Los datos van dentro del plugin. No se conecta a ningún servidor externo, no carga scripts de terceros y no guarda datos de visitantes.

**Shortcodes**

* `[festivos region="ES-MD"]` tabla con todos los festivos de la comunidad (nacionales + autonómicos), con el día de la semana y el ámbito. El festivo de hoy se resalta y los pasados se atenúan. Añade `fuente="0"` para ocultar la línea con el boletín oficial.
* `[festivos_proximo region="ES-CT"]` frase con el próximo festivo y los días que faltan.
* `[festivos_hoy region="ES-AN"]` dice si hoy es festivo en esa comunidad.

El atributo `region` acepta el código ISO 3166-2 (ES-AN, ES-AR, ES-AS, ES-IB, ES-CN, ES-CB, ES-CL, ES-CM, ES-CT, ES-EX, ES-GA, ES-MD, ES-MC, ES-NC, ES-PV, ES-RI, ES-VC) o el nombre de la comunidad (madrid, cataluña, pais vasco...). Sin `region` se usa la comunidad elegida en Ajustes > Festivos España; si no hay ninguna, solo los festivos nacionales.

**Qué incluye 2027**

* 1 de mayo y 25 de diciembre caen en sábado y no se trasladan.
* 15 de agosto cae en domingo: Madrid, Aragón, Andalucía, Asturias, Canarias y Castilla y León lo pasan al lunes 16; Extremadura al 11 de octubre; Castilla-La Mancha usa el hueco para el 31 de mayo.
* Navarra tiene 13 fechas porque el 3 de diciembre es fiesta para toda la comunidad.
* Las fiestas locales (dos por municipio) no están incluidas. Ceuta y Melilla tampoco, de momento.

**Datos**

Los datos proceden de la Resolución de 8 de octubre de 2026 (BOE de 13 de octubre de 2026) y de los decretos y resoluciones de cada comunidad autónoma, revisados uno a uno. Están publicados con licencia CC BY 4.0 en https://github.com/RB9744/spain-public-holidays y los mantiene el equipo de SueldoClaro. El enlace de crédito en el front es opcional y viene desactivado.

**English**

Official public holidays of Spain for 2027 (national plus the 17 autonomous communities) with three shortcodes: holiday table, next holiday, and "is today a holiday". All data is bundled, no external requests.

== Installation ==

1. Sube la carpeta `festivos-espana` a `/wp-content/plugins/` o instálalo desde Plugins > Añadir nuevo.
2. Activa el plugin.
3. Opcional: en Ajustes > Festivos España elige tu comunidad por defecto.
4. Pon `[festivos]`, `[festivos_proximo]` o `[festivos_hoy]` en cualquier página, entrada o widget de texto.

== Frequently Asked Questions ==

= ¿Incluye las fiestas locales de mi ayuntamiento? =

No. Las dos fiestas locales las publica cada ayuntamiento en su boletín provincial a lo largo del otoño. El plugin cubre los festivos nacionales y los autonómicos.

= ¿De dónde salen las fechas? =

De los boletines oficiales: el BOE para las fechas nacionales y el boletín de cada comunidad para las autonómicas. Cada tabla muestra la fuente con enlace (puedes ocultarla con `fuente="0"`).

= ¿Funciona para 2026 o 2028? =

La versión 1.0 trae 2027. Los años siguientes se añaden con una actualización del plugin cuando cada comunidad publica su calendario (normalmente entre marzo y octubre del año anterior).

= ¿Hace peticiones a otros servidores? =

No. Los datos están dentro del plugin, no carga nada externo y no guarda información de los visitantes.

= ¿Puedo cambiar el formato de fecha? =

Las fechas usan el idioma del sitio (día de la semana y mes en el idioma configurado en Ajustes > Generales).

== Screenshots ==

1. Tabla de festivos de la Comunidad de Madrid 2027 con el festivo de hoy resaltado.
2. Página de ajustes con la comunidad por defecto.

== Changelog ==

= 1.0.0 =
* Primera versión: festivos 2027 de España y las 17 comunidades, shortcodes `[festivos]`, `[festivos_proximo]` y `[festivos_hoy]`, página de ajustes.

== Upgrade Notice ==

= 1.0.0 =
Primera versión.
