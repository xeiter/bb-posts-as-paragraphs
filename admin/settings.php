<?php

/**
 * Hook into WordPress admin menu initialisation
 */
add_action('admin_menu', 'register_bb_posts_as_paragraphs_settings_page');
function register_bb_posts_as_paragraphs_settings_page() {
	add_options_page('Posts as Paragraphs', 'Posts as Paragraphs', 'manage_options', 'bb_posts_as_paragraphs_options', 'bb_posts_as_paragraphs_options_page');
	add_action('admin_init', 'register_bb_posts_as_paragraphs_options');
}

/**
 * Generate and output a settings page for Social Impact
 */
function bb_posts_as_paragraphs_options_page() {

	$html = bb_posts_as_paragraphs_settings_page_get_full_mark_up( 'bb-posts-as-paragraphs-options-group' );
	echo $html;

}

/**
 * Register WordPress options for Social Impact
 */
function register_bb_posts_as_paragraphs_options() {

	$post_types = get_post_types();
	$post_types_blacklist = array( 'post', 'attachment', 'revision', 'nav_menu_item', 'acf-field-group', 'acf-field', 'calendar', 'repost' );

	$fields = '';
	foreach ( $post_types as $post_type ) {
		if ( ! in_array( $post_type, $post_types_blacklist ) ) {
			$fields['bb_posts_as_paragraphs_setting_' . $post_type . '_intro' ] = '';
		}
	}

	// Push default values into the options
	foreach ( $fields as $field => $value ) {
		register_setting( 'bb-posts-as-paragraphs-options-group', $field );

		if ( !empty( $value ) && !get_option( $field ) ) {
			update_option( $field, $value );
		}
	}

}

/**
 * Generate HTML mark up for a settings page
 *
 * @return string
 */
function bb_posts_as_paragraphs_settings_page_get_full_mark_up( $option_group ) {

	$html = '';

	$html .= _bb_posts_as_paragraphs_settings_page_get_page_prefix_up( $option_group );
	// $html .= _bb_posts_as_paragraphs_settings_page_get_popdown_up( $option_group );
	// $html .= _bb_posts_as_paragraphs_settings_page_get_nag_up( $option_group );
	$html .= _bb_posts_as_paragraphs_settings_page_get_form_mark_up( $option_group );
	$html .= _bb_posts_as_paragraphs_settings_page_get_page_suffix_up( $option_group );

	return $html;

}

/**
 * Generate HTML for the page prefix
 *
 * @param string $option_group
 * @return string
 */
function _bb_posts_as_paragraphs_settings_page_get_page_prefix_up( $option_group ) {

	$html = <<<MULTI
<div id="wpbody-content" aria-label="Main content" tabindex="0">
MULTI;
	;

	return $html;

}

/**
 * Generate HTML for popdown help section
 *
 * @param string $option_group
 * @return string
 */
function _bb_posts_as_paragraphs_settings_page_get_popdown_up( $option_group ) {

	$html = <<<MULTI
    
    <div id="screen-meta" class="metabox-prefs">

        <div id="contextual-help-wrap" class="hidden" tabindex="-1" aria-label="Contextual Help Tab">
            <div id="contextual-help-back"></div>
            <div id="contextual-help-columns">
                <div class="contextual-help-tabs">
                    <ul>

                        <li id="tab-link-overview" class="active">
                            <a href="#tab-panel-overview" aria-controls="tab-panel-overview">
                                Overview								</a>
                        </li>
                    </ul>
                </div>

                <div class="contextual-help-sidebar">
                    <p><strong>For more information:</strong></p><p><a href="https://codex.wordpress.org/Settings_General_Screen" target="_blank">Documentation on General Settings</a></p><p><a href="https://wordpress.org/support/" target="_blank">Support Forums</a></p>					</div>

                <div class="contextual-help-tabs-wrap">

                    <div id="tab-panel-overview" class="help-tab-content active">
                        <p>The fields on this screen determine some of the basics of your site setup.</p><p>Most themes display the site title at the top of every page, in the title bar of the browser, and as the identifying name for syndicated feeds. The tagline is also displayed by many themes.</p><p>The WordPress URL and the Site URL can be the same (example.com) or different; for example, having the WordPress core files (example.com/wordpress) in a subdirectory instead of the root directory.</p><p>If you want site visitors to be able to register themselves, as opposed to by the site administrator, check the membership box. A default user role can be set for all new users, whether self-registered or registered by the site admin.</p><p>You can set the language, and the translation files will be automatically downloaded and installed (available if your filesystem is writable).</p><p>UTC means Coordinated Universal Time.</p><p>You must click the Save Changes button at the bottom of the screen for new settings to take effect.</p>							</div>
                </div>
            </div>
        </div>
    </div>

    <div id="screen-meta-links">
        <div id="contextual-help-link-wrap" class="hide-if-no-js screen-meta-toggle">
            <button type="button" id="contextual-help-link" class="button show-settings" aria-controls="contextual-help-wrap" aria-expanded="false">Help</button>
        </div>
    </div>
MULTI;

	return $html;

}

/**
 * Generate HTML for a nag section
 *
 * @param string $option_group
 * @return string
 */
function _bb_posts_as_paragraphs_settings_page_get_nag_up( $option_group ) {

	$html = <<<MULTI
    
    <div class="update-nag"><a href="https://codex.wordpress.org/Version_4.5.3">WordPress 4.5.3</a> is available! <a href="/wp-admin/update-core.php" aria-label="Please update WordPress now">Please update now</a>.</div><!-- Previously Dismissed Alert: `&lt;p&gt;&lt;span class=&quot;backupbuddy-icon-drive&quot;&gt;&lt;/span&gt;Real-time backups are here. &lt;a class=&quot;backupbuddy-nag-button pb_backupbuddy_disalert&quot; href=&quot;/wp-admin/admin.php?page=pb_backupbuddy_live&quot; alt=&quot;/wp-admin/admin-ajax.php?action=pb_backupbuddy_backupbuddy&amp;function=disalert&quot;&gt;Get Started&lt;/a&gt;&lt;a class=&quot;backupbuddy-nag-button&quot; href=&quot;https://ithemes.com/backupbuddy-stash-live-is-here&quot; target=&quot;_blank&quot;&gt;See What's New&lt;/a&gt;&lt;/p&gt;` -->
    
MULTI;

	return $html;

}

/**
 * Generate HTML for a form section
 *
 * @param string $option_group
 * @return string
 */
function _bb_posts_as_paragraphs_settings_page_get_form_mark_up( $option_group ) {

	// Prefix that will be used in the name of all fields
	$field_name_prefix = 'bb_posts_as_paragraphs_setting_';

	// Build hidden fields and nonce section
	$nonce_html = '<input type="hidden" name="option_page" value="' . esc_attr( $option_group ) . '" /><input type="hidden" name="action" value="update" />';
	$nonce_html .= wp_nonce_field("$option_group-options");

	// Build Submit button mark up
	$submit_button_html = get_submit_button( $text = null, $type = 'primary', $name = 'submit' );

	$post_types = get_post_types();
	$post_types_blacklist = array( 'post', 'attachment', 'revision', 'nav_menu_item', 'acf-field-group', 'acf-field', 'calendar', 'repost' );

	$fields = '';
	foreach ( $post_types as $post_type ) {
		if ( !in_array( $post_type, $post_types_blacklist ) ) {

			$post_type_uc = ucwords( $post_type );
			$settings = array(
				'teeny' => true,
				'textarea_rows' => 15,
				'tabindex' => 1
			);

			ob_start();
			wp_editor( get_option( $field_name_prefix  . $post_type . '_intro' ), $field_name_prefix . $post_type . '_intro', $settings );
			$editor_html = ob_get_clean();

			$fields .= <<<MULTI
<tr>
    <th><label for="{$field_name_prefix}{$post_type}_intro">Intro for {$post_type_uc} CPT:</label></th>
    <td>{$editor_html}</td>
</tr>
MULTI;

		}
	}

	// Compile final form mark up
	$html = <<<MULTI
<div class="wrap">

        <h1>Pages as Paragraphs Settings</h1>

        <form method="post" action="options.php" novalidate="novalidate">
            
            {$nonce_html}
            
            <table class="form-table">
                <tbody>
                    {$fields}
                </tbody>
            </table>
            
            <p class="submit">{$submit_button_html}</p></form>

    </div>    
MULTI;

	return $html;

}

/**
 * Generate HTML for a suffix of the settings page
 *
 * @param string $option_group
 * @return string
 */
function _bb_posts_as_paragraphs_settings_page_get_page_suffix_up( $option_group ) {

	$html = <<<MULTI

    <div class="clear"></div>
</div>

MULTI;

	return $html;

}