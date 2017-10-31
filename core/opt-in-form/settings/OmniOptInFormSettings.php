<?php
define('OPT_IN_MENU_SLUG', 'omni-opt-in-menu');
class OmniOptInFormSettings {

	private $options;

	public function __construct() {
		add_action('admin_menu', array($this, 'omni_wp_theme_opt_in_settings_page'));
		add_action('admin_init', array($this, 'omni_wp_theme_add_opt_in_entry_display'));
		add_action('admin_menu', array($this, 'omni_opt_in_add_submenu_links'));
		add_action('admin_enqueue_scripts', array($this, 'omni_wp_theme_localize_admin_ajax_script'));
		add_action( 'wp_ajax_omni_wp_theme_export_opt_in_results', array($this, 'omni_wp_theme_export_opt_in_results') );
		 add_action( 'wp_ajax_omni_wp_theme_export_opt_in_results', array($this, 'omni_wp_theme_export_opt_in_results') );
	}

	public function omni_opt_in_add_submenu_links() {
		global $submenu;
		$opt_in_link = 'admin.php?page=omni-opt-in-menu&tab=entries';
		$submenu[OPT_IN_MENU_SLUG][] = array('Entries', 'manage_options', $opt_in_link);
	}

	public function omni_wp_theme_opt_in_settings_page() {
		global $omni_opt_in_menu;
		$omni_opt_in_menu = add_menu_page(
			'Opt In',
			'Opt In',
			'manage_options',
			OPT_IN_MENU_SLUG,
			array($this, 'omni_wp_theme_opt_in_menu_options')
		);
	}

	public function omni_wp_theme_opt_in_menu_options() {
		global $omni_opt_in_tabs;

		$this->options = get_option('omni_entries_options');

		$omni_opt_in_tabs['1'] = array('entries' => 'Entries'); ?>

		<div class="wrap">
		<h2>Opt In Form Page</h2>
		<?php settings_errors(); ?>

		<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'entries'; ?>

		<h2 class="nav-tab-wrapper">
			<?php
			ksort($omni_opt_in_tabs);
			foreach($omni_opt_in_tabs as $tab) :
				foreach($tab as $key => $value) :?>
					<a href="?page=omni-opt-in-menu&tab=<?php echo $key; ?>" class="nav-tab <?php echo $active_tab == $key ? 'nav-tab-active' : ''; ?>"><?php echo $value; ?></a>
				<?php endforeach; endforeach; ?>
		</h2>
		<form method="post" action="options.php" id="nrw-dashboard-options">
			<?php settings_fields('omni_' . $active_tab . '_group'); ?>
			<?php do_settings_sections('omni_' . $active_tab . '_group'); ?>
		</form>
		</div>
	<?php }

	public function omni_wp_theme_add_opt_in_entry_display() {
		register_setting(
			'omni_entries_group',
			'omni_entries_options',
			array( $this, 'sanitize')
		);
		add_settings_section(
			'omni_entries',
			'Entries',
			array($this, 'omni_print_entries_table'),
			'omni_entries_group'
		);
	}

	public function omni_print_entries_table() {
	    // self::omni_wp_theme_export_opt_in_results();
		?>
		<div class="tablenav top">
			<div class="alignleft actions bulkactions">
				<button type="button" id="export" class="button">Export to Excel</button>
			</div>
		</div>
        <div id="omni_opt_in_results">
            <title>Test</title>
            <table class="wp-list-table widefat fixed striped entries">
                <thead>
                    <tr>
                        <td id="cb" class="manage-column column-cb check-column">
                            <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                            <input id="cb-select-all-1" type="checkbox">
                        </td>
                        <th scope="col" id="type" class="manage-column column-type column-primary sortable desc">
                            Type
                        </th>
                        <th scope="col" id="value" class="manage-column column-value">
                            Value
                        </th>
                        <th scope="col" id="time" class="manage-column column-time">
                            Time Entered
                        </th>
                        <th scope="col" id="ip_address" class="manage-column column-ip_address">
                            IP Address
                        </th>
                    </tr>
                </thead>
                <tbody id="the-list">
                    <?php
                        $results = self::omni_wp_theme_get_opt_in_results();
                        // p($results);
                    ?>
                <?php foreach($results as $result) : ?>
                    <tr>
                        <th scope="row" class="check-column">
                            <label class="screen-reader-text" for="cb-select-<?php echo $result->id; ?>">Select <?php echo $result->value; ?></label>
                            <input id="cb-select-<?php echo $result->id ?>" type="checkbox" name="post[]" value="<?php
                            echo $result->id; ?>">
                            <div class="locked-indicator">
                                <span class="locked-indicator-icon" aria-hidden="true"></span>
                                <span class="screen-reader-text">“<?php echo $result->value; ?>” is locked</span>
                            </div>
                        </th>
                        <td class="type column-type" data-colname="Type">
                            <?php echo self::omni_wp_theme_get_opt_in_type($result->type); ?>
                        </td>
                        <td class="value column-value" data-colname="Value">
                            <?php echo $result->value; ?>
                        </td>
                        <td class="time column-time" data-colname="Time">
                            <?php echo $result->time; ?>
                        </td>
                        <td class="ip_address column-ip_address" data-colname="IP Address">
                            <?php echo $result->ip_address; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
	<?php }

	private function omni_wp_theme_get_opt_in_results() {
		global $wpdb;
		$table_name = $table_name = $wpdb->prefix . 'omni_opt_in';
		return $wpdb->get_results('SELECT * FROM ' . $table_name, OBJECT);
	}

	private function omni_wp_theme_get_opt_in_type($type) {
		switch($type) {
			case 'zip_code':
				return 'Zip Code';
			case 'email':
				return 'Email Address';
			default:
				return 'No Type';
		}
	}

	public function omni_wp_theme_export_opt_in_results(){
	    global $wpdb;

	    $data = array();

		$table_name = $table_name = $wpdb->prefix . 'omni_opt_in';
	    $column_headers = $wpdb->get_results('SHOW COLUMNS FROM ' . $table_name);
	    $col_headers = array();
        if(count($column_headers) > 0) {
            foreach ($column_headers as $column_header) {
                $col_headers[] = $column_header->Field;
            }
        }
        $data[] = $col_headers;
        $rows = self::omni_wp_theme_get_opt_in_results();
        foreach ($rows as $row) {
            $item = array($row->id, $row->time, $row->value, $row->type, $row->ip_address);
            $data[] = $item;
        }
        echo json_encode($data);
        die();
    }

	private function cleanData(&$str) {
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
	}

	public function sanitize($input) {
		return $input;
	}

	public function omni_wp_theme_localize_admin_ajax_script() {
		wp_enqueue_script( 'omni-admin-ajax-script',get_template_directory_uri() . '/admin/js/admin-ajax.js', array
		('jquery'), false, true  );

		wp_localize_script( 'omni-admin-ajax-script', 'omni_admin_ajax', array(
			'ajax_url' => admin_url('admin-ajax.php')
		));
	}


}
$omni_opt_in_form_settings = new OmniOptInFormSettings();