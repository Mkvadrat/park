<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'park' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '1234' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'iaK-qW$HM3+x<bE(/8^SPC|+cH/ninR=xO2Z:X3x|pidl:5iU{6DDh75%jf/qyeg' );
define( 'SECURE_AUTH_KEY',  'i!##j{K8*0)g.p<M{>7W4i:r+F/!<((oi-4D($Bm!(EX+Es@*iIoCDz1E$=9:GLI' );
define( 'LOGGED_IN_KEY',    ':+cb*l5y]2)43lo3IeM_<,*B^/^R$Jb][NZ~U$&pL:T2Wq`UGy?lg9lLhj)Fc[o(' );
define( 'NONCE_KEY',        'e5hX!xg}#O/Mo-XM) wD_e/?9XT4A@ez8]>=5F0K56wNkP:g]o7`$M#m2-MQ8kf8' );
define( 'AUTH_SALT',        'pc%Sod5NkoVvF1J@A0}1J{Iq00u|C%0_!!@v}mP{J>0AqVYwDOV};;aZ$&hLUlzv' );
define( 'SECURE_AUTH_SALT', 'hIHSi9C?VA[C9=ymC]`rqQy-.W)=uVTTI<19yt@-j|eR8]i^^#xREz|K?0Xw?yj-' );
define( 'LOGGED_IN_SALT',   '(M2A]w^$& ^;1i5~n>h|M kh$qz#AgQLd6M<5|!X`c$Ue998/RAOR.=#+dP}ID=3' );
define( 'NONCE_SALT',       'H/T&3rU?zLtj# +{C?{/Ck,c?^54_YnGk]V%<jtuu$#KWuwS5z},V;bF<yuxZv&F' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'kxxsk_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
//Disable File Edits
define('DISALLOW_FILE_EDIT', true);