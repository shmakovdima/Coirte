<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */


//Вырубание Contact form, где не надо
define('WPCF7_LOAD_JS', false);
define('WPCF7_LOAD_CSS', false);




// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'coirte_new');

/** Имя пользователя MySQL */
define('DB_USER', 'coirte_new');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'as210100');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'em&t4j/t+hY;,%Yt]&D:t?+Y!:,ZOw5gl3[wcw`i0NKmx)IR^=Tqj`X:X|+{2`Er');
define('SECURE_AUTH_KEY',  '<5gd_XyF^Tbo#T|#)fY7:;~>Go&0V+=&-Z*yMr]H@x~v)u;GV5JMy1|;q HdDMJv');
define('LOGGED_IN_KEY',    '@Y]_d9xqML7M=dxny! FV/S4kA~-|N:HbhkIEC[p(!]rSFGI!$NR-Db 8]!Y||_-');
define('NONCE_KEY',        'szgPi4VD]Ni]( LaB;.8|F{BAW,_ !gz8!x>kEd<v-G~X_lb:_c,#t^RU9O:bl7y');
define('AUTH_SALT',        '+*H]l)pkb{c41dlBHN]yx.w)98)@uG:bWhl&uQg%$3.+S^6_=Q++mC:8f Si)<bn');
define('SECURE_AUTH_SALT', '<8q#TOl{ZrQ-38|(/wv``{TOGZB`)Y|3w,m2snzG+qF;9%OU~|h7!,9ln+ZBF]DE');
define('LOGGED_IN_SALT',   '$-AZe1zNm-VU ._|N&,c%G{J01+]7?Y*|y7W-3Ml_#K^A2#D8f*S$w7z1i|.1uTV');
define('NONCE_SALT',       'B&J#t@4hz/+LarMU(!!L5rx2r,~/8+Af|IOu@2]Nzp/{$|^j!.{9 %|)@hHG;a]n');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'cm_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
