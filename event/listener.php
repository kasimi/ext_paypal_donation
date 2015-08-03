<?php
/**
 *
 * PayPal Donation extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015 Skouat
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace skouat\ppde\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $controller_helper;

	/** @var \skouat\ppde\controller\main_controller */
	protected $ppde_controller_main;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpEx */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config                    $config               Config object
	 * @param \phpbb\controller\helper                $controller_helper    Controller helper object
	 * @param \skouat\ppde\controller\main_controller $ppde_controller_main Donation pages main controller object
	 * @param \phpbb\template\template                $template             Template object
	 * @param \phpbb\user                             $user                 User object
	 * @param string                                  $php_ext              phpEx
	 *
	 * @return \skouat\ppde\event\listener
	 * @access public
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $controller_helper, \skouat\ppde\controller\main_controller $ppde_controller_main, \phpbb\template\template $template, \phpbb\user $user, $php_ext)
	{
		$this->config = $config;
		$this->controller_helper = $controller_helper;
		$this->ppde_controller_main = $ppde_controller_main;
		$this->template = $template;
		$this->user = $user;
		$this->php_ext = $php_ext;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 * @access public
	 */
	public static function getSubscribedEvents()
	{
		return array(
			'core.index_modify_page_title'       => 'load_index_data',
			'core.page_header'                   => 'add_page_header_link',
			'core.permissions'                   => 'add_permissions',
			'core.user_setup'                    => 'load_language_on_setup',
			'core.viewonline_overwrite_location' => 'viewonline_page',
		);
	}

	/**
	 * Load data for donations statistics
	 *
	 * @param object $event The event object
	 *
	 * @return null
	 * @access public
	 */
	public function load_index_data($event)
	{
		if ($this->config['ppde_enable'] && $this->config['ppde_stats_index_enable'])
		{
			$default_currency_data = $this->ppde_controller_main->get_default_currency_data($this->config['ppde_default_currency']);

			$this->template->assign_vars(array(
				'PPDE_STATS_INDEX_ENABLE' => $this->config['ppde_stats_index_enable'],
				'PPDE_GOAL_ENABLE'        => $this->config['ppde_goal_enable'],
				'PPDE_RAISED_ENABLE'      => $this->config['ppde_raised_enable'],
				'PPDE_USED_ENABLE'        => $this->config['ppde_used_enable'],

				'L_PPDE_GOAL'             => $this->ppde_controller_main->get_ppde_goal_langkey($default_currency_data[0]['currency_symbol']),
				'L_PPDE_RAISED'           => $this->ppde_controller_main->get_ppde_raised_langkey($default_currency_data[0]['currency_symbol']),
				'L_PPDE_USED'             => $this->ppde_controller_main->get_ppde_used_langkey($default_currency_data[0]['currency_symbol']),
			));

			// Generate statistics percent for display
			$this->ppde_controller_main->generate_stats_percent();
		}
	}

	/**
	 * Create a URL to the donation pages controller file for the header linklist
	 *
	 * @param object $event The event object
	 *
	 * @return null
	 * @access public
	 */
	public function add_page_header_link($event)
	{
		$this->template->assign_vars(array(
			'S_PPDE_LINK_ENABLED' => $this->ppde_controller_main->can_use_ppde() && ($this->config['ppde_enable'] && $this->config['ppde_header_link']) ? true : false,
			'U_PPDE_DONATE'       => $this->controller_helper->route('skouat_ppde_main_controller'),
		));
	}

	/**
	 * Load language files during user setup
	 *
	 * @param object $event The event object
	 *
	 * @return null
	 * @access public
	 */
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'skouat/ppde',
			'lang_set' => 'donate',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * Show users as viewing the Donation page on Who Is Online page
	 *
	 * @param object $event The event object
	 *
	 * @return null
	 * @access public
	 */
	public function viewonline_page($event)
	{
		if ($event['on_page'][1] == 'app')
		{
			if (strrpos($event['row']['session_page'], 'app.' . $this->php_ext . '/donate') === 0)
			{
				$event['location'] = $this->user->lang('PPDE_VIEWONLINE');
				$event['location_url'] = $this->controller_helper->route('skouat_ppde_main_controller');
			}
		}
	}

	/**
	 * Add extension permissions
	 *
	 * @param object $event The event object
	 *
	 * @return null
	 * @access public
	 */
	public function add_permissions($event)
	{
		$categories = $event['categories'];
		$categories = array_merge($categories, array('ppde' => 'ACL_CAT_PPDE'));
		$event['categories'] = $categories;

		$permissions = $event['permissions'];
		$permissions = array_merge($permissions, array(
			'a_ppde_manage' => array('lang' => 'ACL_A_PPDE_MANAGE', 'cat' => 'ppde'),
			'u_ppde_use'    => array('lang' => 'ACL_U_PPDE_USE', 'cat' => 'ppde'),
		));
		$event['permissions'] = $permissions;
	}
}