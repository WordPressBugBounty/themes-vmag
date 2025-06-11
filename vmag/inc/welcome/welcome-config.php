<?php
	/**
	 * Welcome Page Initiation
	*/

	get_template_part('/inc/welcome/welcome');

	/** Plugins **/
	$th_plugins = array(
		// *** Companion Plugins
		'companion_plugins' => array(

		),

		//Displays on Required Plugins tab
		'req_plugins' => array(

			// Free Plugins
			'free_plug' => array(
				'kirki' => array(
					'slug' => 'kirki',
					'filename' => 'kirki.php',
					'class' => 'Kirki'
				),
				'accesspress-twitter-feed' => array(
					'slug' => 'accesspress-twitter-feed',
					'filename' => 'accesspress-twitter-feed.php',
					'class' => 'APSS_Class'
				),
				'accesspress-social-share' => array(
					'slug' => 'accesspress-social-share',
					'filename' => 'accesspress-social-share.php',
					'class' => 'APSS_Class'
				),
				'accesspress-social-icons' => array(
					'slug' => 'accesspress-social-icons',
					'filename' => 'accesspress-social-icons.php',
					'class' => 'APS_Class'
				),
				'contact-form-7' => array(
					'slug' => 'contact-form-7',
					'filename' => 'wp-contact-form-7.php',
					'class' => 'WPCF7'
				),
			),
			'pro_plug' => array(

			),
		),

		// *** Displays on Import Demo section
		'required_plugins' => array(
			'access-demo-importer' => array(
					'slug' 		=> 'access-demo-importer',
					'name' 		=> esc_html__('Access Demo Importer', 'vmag'),
					'filename' 	=>'access-demo-importer.php',
					'host_type' => 'wordpress', // Use either bundled, remote, wordpress
					'class' 	=> 'Access_Demo_Importer',
					'info' 		=> esc_html__('Access Demo Importer adds the feature to Import the Demo Conent with a single click.', 'vmag'),
			),
		

		),

		// *** Recommended Plugins
		'recommended_plugins' => array(
			// Free Plugins
			'free_plugins' => array(
				
			),

			// Pro Plugins
			'pro_plugins' => array(

			)
		),
	);

	$strings = array(
		// Welcome Page General Texts
		'welcome_menu_text' => esc_html__( 'VMag', 'vmag' ),
		'theme_short_description' => esc_html__( 'VMag - is a complete Free WordPress theme for online magazines, newspapers and professional blogs. It is completely built on Customizer tool, which allows you to customize most of the theme settings easily with live previews. It is fully widgetized theme so as to let users manage the website using the easy to use widgets. Bold typography, large images and beautiful colors are the main features, which make it ideal for magazines and newspapers. It is a flexible and powerful theme, which provides a lot of customization possibilities to the users. The whole theme structure is built using clean code, making the theme secure and SEO friendly. It is a fully responsive free theme for WordPress. Demo: http://accesspressthemes.com/theme-demos/?theme=vmag Support forum: https://accesspressthemes.com/support/forum/themes/free-themes/vmag/', 'vmag' ),

		// Plugin Action Texts
		'install_n_activate' 	=> esc_html__('Install and Activate', 'vmag'),
		'deactivate' 			=> esc_html__('Deactivate', 'vmag'),
		'activate' 				=> esc_html__('Activate', 'vmag'),

		// Getting Started Section
		'doc_heading' 		=> esc_html__('Step 1 - Documentation', 'vmag'),
		'doc_description' 	=> esc_html__('Read the Documentation and follow the instructions to manage the site , it helps you to set up the theme more easily and quickly. The Documentation is very easy with its pictorial  and well managed listed instructions. ', 'vmag'),
		'doc_link'			=> 'https://doc.accesspressthemes.com/vmag/',
		'doc_read_now' 		=> esc_html__( 'Read Now', 'vmag' ),
		'cus_heading' 		=> esc_html__('Step 2 - Customizer Panel', 'vmag'),
		'cus_read_now' 		=> esc_html__( 'Go to Customizer Panels', 'vmag' ),

		// Recommended Plugins Section
		'pro_plugin_title' 			=> esc_html__( 'Premium Plugins', 'vmag' ),
		'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'vmag' ),

		

		// Demo Actions
		'activate_btn' 		=> esc_html__('Activate', 'vmag'),
		'installed_btn' 	=> esc_html__('Activated', 'vmag'),
		'demo_installing' 	=> esc_html__('Installing Demo', 'vmag'),
		'demo_installed' 	=> esc_html__('Demo Installed', 'vmag'),
		'demo_confirm' 		=> esc_html__('Are you sure to import demo content ?', 'vmag'),

		// Actions Required
		'req_plugin_info' => esc_html__('All these required plugins will be installed and activated while importing demo. Or you can choose to install and activate them manually. If you\'re not importing any of the demos, you must install and activate these plugins manually.', 'vmag' ),
		'req_plugins_installed' => esc_html__( 'All Recommended action has been successfully completed.', 'vmag' ),
		'customize_theme_btn' 	=> esc_html__( 'Customize Theme', 'vmag' ),
		'pro_plugin_title' 			=> esc_html__( 'Premium Plugins', 'vmag' ),
		'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'vmag' ),
	);

	/**
	 * Initiating Welcome Page
	*/
	$my_theme_wc_page = new Accesspress_Mag_Welcome( $th_plugins, $strings );