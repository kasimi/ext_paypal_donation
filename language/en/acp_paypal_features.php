<?php
/**
 *
 * PayPal Donation extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2017 Skouat
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

/**
 * mode: PayPal features
 */
$lang = array_merge($lang, array(
	'PPDE_PAYPAL_FEATURES'                 => 'PayPal IPN features',
	'PPDE_PAYPAL_FEATURES_EXPLAIN'         => 'Here you can configure all features that use the PayPal Instant Payment Notification (IPN).',

	// PayPal IPN settings
	'PPDE_LEGEND_IPN_AUTOGROUP'            => 'Auto-group',
	'PPDE_LEGEND_IPN_DONORLIST'            => 'Donors list',
	'PPDE_LEGEND_IPN_NOTIFICATION'         => 'Notification system',
	'PPDE_LEGEND_IPN_SETTINGS'             => 'General settings',
	'PPDE_IPN_AG_ENABLE'                   => 'Enable Auto Group',
	'PPDE_IPN_AG_ENABLE_EXPLAIN'           => 'Allows to add donors to a predefined group.',
	'PPDE_IPN_AG_DONORS_GROUP'             => 'Donors group',
	'PPDE_IPN_AG_DONORS_GROUP_EXPLAIN'     => 'Select the group that will host the donor members.',
	'PPDE_IPN_AG_GROUP_AS_DEFAULT'         => 'Set donors group as default',
	'PPDE_IPN_AG_GROUP_AS_DEFAULT_EXPLAIN' => 'Enable to set the donors group as the default group for users having make a donation.',
	'PPDE_IPN_DL_ENABLE'                   => 'Enable Donors list',
	'PPDE_IPN_DL_ENABLE_EXPLAIN'           => 'Allows to enable the list of donors.',
	'PPDE_IPN_ENABLE'                      => 'Enable IPN',
	'PPDE_IPN_ENABLE_EXPLAIN'              => 'Enable this option if you want use Instant Payment Notification of PayPal services.<br />If enabled, all features dependent on PayPal IPN will be available below.',
	'PPDE_IPN_LOGGING'                     => 'Enable log errors',
	'PPDE_IPN_LOGGING_EXPLAIN'             => 'Log errors and data from PayPal IPN into the directory <strong>/store/ext/ppde/</strong>.',
	'PPDE_IPN_NOTIFICATION_ENABLE'         => 'Enable notification',
	'PPDE_IPN_NOTIFICATION_ENABLE_EXPLAIN' => 'Allows to notify PPDE admin and donors when a donation is received.',

	// PayPal sandbox settings
	'PPDE_LEGEND_SANDBOX_SETTINGS'         => 'Sandbox settings',
	'PPDE_SANDBOX_ENABLE'                  => 'Sandbox testing',
	'PPDE_SANDBOX_ENABLE_EXPLAIN'          => 'Enable this option if you want use PayPal Sandbox instead of PayPal services.<br />Useful for developers/testers. All the transactions are fictitious.',
	'PPDE_SANDBOX_FOUNDER_ENABLE'          => 'Sandbox only for founder',
	'PPDE_SANDBOX_FOUNDER_ENABLE_EXPLAIN'  => 'If enabled, PayPal Sandbox will be displayed only by the board founders.',
	'PPDE_SANDBOX_ADDRESS'                 => 'PayPal Sandbox Account',
	'PPDE_SANDBOX_ADDRESS_EXPLAIN'         => 'Enter the PayPal Sandbox email address or Merchant ID.',
));

/**
 * Confirm box
 */
$lang = array_merge($lang, array(
	'PPDE_PAYPAL_FEATURES_SAVED' => 'PayPal IPN features saved.',
));

/**
 * Errors
 */
$lang = array_merge($lang, array(
	'PPDE_PAYPAL_FEATURES_MISSING' => 'Please check “Sandbox address”.',
));