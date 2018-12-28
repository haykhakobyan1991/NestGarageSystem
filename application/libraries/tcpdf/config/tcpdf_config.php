<?php
define ('K_PATH_IMAGES', 'lims/themes/frontend/lims_default/img/imgs/');

define ('emblem', 'emblem.png');
define ('header', 'header.png');


/**
 * Generic name for a blank image.
 */
define ('K_BLANK_IMAGE', '_blank.png');

/**
 * Page format.
 */
define ('PDF_PAGE_FORMAT', 'A4');

/**
 * Page orientation (P=portrait, L=landscape).
 */
define ('PDF_PAGE_ORIENTATION', 'P');

/**
 * Document creator.
 */
define ('PDF_CREATOR', 'PDF');

/**
 * Document author.
 */
define ('PDF_AUTHOR', 'PDF');

/**
 * Header title.
 */
define ('PDF_HEADER_TITLE', '');

/**
 * Header description string.
 */
define ('PDF_HEADER_STRING', "“REPUBLICAN VETERINARY-SANITARY AND \nPHYTOSANITARY CENTER OF LABORATORY \n
SERVICES” STATE NON COMMERCIAL \n ORGANISATION");

/**
 * Document unit of measure [pt=point, mm=millimeter, cm=centimeter, in=inch].
 */
define ('PDF_UNIT', 'mm');

/**
 * Header margin.
 */
define ('PDF_MARGIN_HEADER', 5);

// PDF HEADER LOGO WIDTH
define ('PDF_HEADER_LOGO_WIDTH', 200);
/**
 * Footer margin.
 */
define ('PDF_MARGIN_FOOTER', 15);

/**
 * Top margin.
 */
define ('PDF_MARGIN_TOP', 65); //////////////////////////////////////// 

/**
 * Bottom margin.
 */
define ('PDF_MARGIN_BOTTOM', 25);

/**
 * Left margin.
 */
define ('PDF_MARGIN_LEFT', 8);

define ('STANDART_LEFT', 5);

/**
 * Right margin.
 */
define ('PDF_MARGIN_RIGHT', 8);

/**
 * Default main font name.
 */
define ('PDF_FONT_NAME_MAIN', 'helvetica');

/**
 * Default main font size.
 */
define ('PDF_FONT_SIZE_MAIN', 10);

/**
 * Default data font name.
 */
define ('PDF_FONT_NAME_DATA', 'helvetica');

/**
 * Default data font size.
 */
define ('PDF_FONT_SIZE_DATA', 8);

/**
 * Default monospaced font name.
 */
define ('PDF_FONT_MONOSPACED', 'courier');

/**
 * Ratio used to adjust the conversion of pixels to user units.
 */
define ('PDF_IMAGE_SCALE_RATIO', 1.25);

/**
 * Magnification factor for titles.
 */
define('HEAD_MAGNIFICATION', 1.1);

/**
 * Height of cell respect font height.
 */
define('K_CELL_HEIGHT_RATIO', 1.25);

/**
 * Title magnification respect main font size.
 */
define('K_TITLE_MAGNIFICATION', 1.3);

/**
 * Reduction factor for small font.
 */
define('K_SMALL_RATIO', 2/3);

/**
 * Set to true to enable the special procedure used to avoid the overlappind of symbols on Thai language.
 */
define('K_THAI_TOPCHARS', true);

/**
 * If true allows to call TCPDF methods using HTML syntax
 * IMPORTANT: For security reason, disable this feature if you are printing user HTML content.
 */
define('K_TCPDF_CALLS_IN_HTML', false);

/**
 * If true and PHP version is greater than 5, then the Error() method throw new exception instead of terminating the execution.
 */
define('K_TCPDF_THROW_EXCEPTION_ERROR', false);

/**
 * Default timezone for datetime functions
 */
define('K_TIMEZONE', 'UTC');

//============================================================+
// END OF FILE
//============================================================+
