<?php

/**
 * Composer integration for Contao.
 *
 * PHP version 5
 *
 * @copyright  ContaoCommunityAlliance 2013
 * @author     Dominik Zogg <dominik.zogg at gmail.com>
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    Composer
 * @license    LGPLv3
 * @filesource
 */

if (version_compare(PHP_VERSION, '5.3', '<')) {
	trigger_error('Composer client requires PHP 5.3, even with Contao 2.11', E_USER_ERROR);
	return;
}

if (version_compare(VERSION, '3', '<')) {
	include(__DIR__ . '/../ContaoCommunityAlliance/Contao/Composer/ClassLoader.php');
	\ContaoCommunityAlliance\Contao\Composer\ClassLoader::register();
	spl_autoload_register('__autoload');
	\Contao2ClassFileExistsHack::register();
}

define('COMPOSER_MIN_PHPVERSION', '5.3.4');
define('COMPOSER_DIR_RELATIVE', 'composer');
define('COMPOSER_DIR_ABSOULTE', TL_ROOT . '/' . COMPOSER_DIR_RELATIVE);


/**
 * Create initial composer.json
 */
\ContaoCommunityAlliance\Contao\Composer\Runtime::initialize();


/**
 * Add backend module
 */
$GLOBALS['BE_MOD']['system']['composer'] = array(
	'callback'   => 'ContaoCommunityAlliance\Contao\Composer\ClientBackend',
	'icon'       => 'system/modules/!composer/assets/images/icon.png',
	'stylesheet' => 'system/modules/!composer/assets/css/backend.css',
);
