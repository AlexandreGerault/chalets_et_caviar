<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'chalets_et_caviar' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'chalets_et_caviar' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '7z}/w`QHo1<JH~b@#Tm>f:SmT(w*]yA2u]jxe]uO7 nP#/~P{E JJq6lsD8A_bo2' );
define( 'SECURE_AUTH_KEY',  '.U,d5Trnf_LVNK1b<6vFA|(u36IOE?GHE|kB#VTS3GDS4Tkc)R*VJMsIP6-VE916' );
define( 'LOGGED_IN_KEY',    'Ld=8,e~(K~QPh*}, 6Uz79U-;E?h|js/eAucywNQGgDQrl6yjPA}6;!GFSj:It{R' );
define( 'NONCE_KEY',        '@gBgv%XzV{G/9_+1iM2Mb~;$|ip?#{z66Gbj}S,Z/TL8rLWklVB.m.23Ia@0,56X' );
define( 'AUTH_SALT',        'S569zc/1f ROS>VmqdjkOEd-J9*f  k7/NGP1z^t-uq7w|-@inft!u>bTSf)EpB/' );
define( 'SECURE_AUTH_SALT', 'uzSY-G;yJOLh_,-8 X^FK9M`3D0KRg}F]Pr?ccZSDKX-G8|w.o4i?%KQhAP|fE)8' );
define( 'LOGGED_IN_SALT',   'a!B]+65T{az2NE?RB_av6`0h@vZfm,vC(C}L%3rulWu}xj-K!<ogKc_YhU@<[wu,' );
define( 'NONCE_SALT',       '5<nAv<l]]2]D>bUj8df8>fWvd_YR)G)2Uac0.P+=0D)6iNC/Cww&6pRl3.%fbzmA' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'chalets_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
