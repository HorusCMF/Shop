<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wordpress');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'djscrave');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'SPyK5E&mpw~I@5_3=+dT%.si0GZPd#1[$HQ$u477XsTbq=&/l das_3XPpovAg-;');
define('SECURE_AUTH_KEY',  'uuMr2x)by5{-K-JkD0+EW~B=twUfa5Hx[l >+aI<DP<jf3R?;a)[u?7.p[Rgk11y');
define('LOGGED_IN_KEY',    '=0%:=P64*Ou2cSx{?pJp^ v,eJuGfUE[4Lp9R[mHJ./r{CE_E1:+P3XZABn$Hx]Q');
define('NONCE_KEY',        '!o$D$F8vJJf{/_lR|,&||^&PvQ`|g`.S 3$nWmIT@|Rp0i7BmF}Qw0Y9;e2]}`SN');
define('AUTH_SALT',        'JXME^w+b~v&>#!2n4;g6MamMsbEV2Z}I5c6: 4Hj(2g9+ :]h<2qIE+@o-YWG[+}');
define('SECURE_AUTH_SALT', '|@,$4}41K$PVg))O]S7e?8qjZA1+q.plXeIr@6H/b+?E|p:+wLnTzMN/o-fs.|YP');
define('LOGGED_IN_SALT',   'hWT28C!-@l+q]1ka#_r&MSV%we+[dRGhy2 ACO?P8Zb|P/SOM8Gm8zX#6.W?sW(y');
define('NONCE_SALT',       'rCU4{|.R/F2-$JEcJ1X+M^DV@EkCd{]q$Oz;>[=@o.44-8-iHS#Iqh~0HeBU[oW+');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');