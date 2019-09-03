<?php
add_action( 'tgmpa_register', '_pa_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function _pa_register_required_plugins() {
	$plugins = array(
		array(
			'name'               => 'Regenerate Thumbnails', // The plugin name.
			'slug'               => 'regenerate-thumbnails', // The plugin slug (typically the folder name).
			'required'           => false, // recommended
			'version'            => '3.1.1', // Must be this or higher
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),
		array(
			'name'               => '_pa Tweaks',
			'slug'               => '_pa-tweaks',
			'source'             => get_template_directory() . '/_plugins/_pa-tweaks.zip',
			'required'           => false, // recommended
			'version'            => '1.2', // Must be this or higher
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		// Yoast SEO or Yoast SEO Premium
		array(
			'name'				=> 'WordPress SEO by Yoast',
			'slug'				=> 'wordpress-seo',
			'required'			=> false,
			'is_callable'		=> 'wpseo_init',
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'					=> '_pa',					// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'			=> '',						// Default absolute path to bundled plugins.
		'menu'					=> 'tgmpa-install-plugins',	// Menu slug.
		'has_notices'			=> true,					// Show admin notices or not.
		'dismissable'			=> true,					// If false, a user cannot dismiss the nag message.
		'dismiss_msg'			=> '',						// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'			=> true,					// Automatically activate plugins after installation or not.
		'message'				=> '',						// Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}
