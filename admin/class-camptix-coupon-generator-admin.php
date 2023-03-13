<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://vagelis.dev
 * @since      1.0.0
 *
 * @package    Camptix_Coupon_Generator
 * @subpackage Camptix_Coupon_Generator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Camptix_Coupon_Generator
 * @subpackage Camptix_Coupon_Generator/admin
 * @author     Vagelis Papaioannou <hello@vagelis.dev>
 */
class Camptix_Coupon_Generator_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Camptix_Coupon_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Camptix_Coupon_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/camptix-coupon-generator-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Camptix_Coupon_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Camptix_Coupon_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/camptix-coupon-generator-admin.js', array('jquery'), $this->version, true);
	}

	/**
	 * Load the Coupon Log.
	 *
	 * @since    1.0.0
	 */
	public function coupon_log()
	{
		$log_file = WP_CONTENT_DIR . '/' . LOG_FILE_NAME;

		if (file_exists($log_file)) {
			$log_content = file_get_contents($log_file);
			$log_lines = explode(PHP_EOL, $log_content);
?>
			<table>
				<thead>
					<tr>
						<th>Date</th>
						<th>Coupon Code</th>
						<th>Status</th>
						<th>Email Address</th>
						<th>Email Sent</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($log_lines as $line) : ?>
						<?php if (!empty($line)) : ?>
							<?php list($date, $code, $status, $email_address, $email_sent) = explode(',', $line); ?>
							<tr>
								<td><?php echo $date; ?></td>
								<td><?php echo $code; ?></td>
								<td><?php echo $status; ?></td>
								<td><?php echo $email_address; ?></td>
								<td><?php echo $email_sent; ?></td>
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php
		} else {
			echo 'Log file not found.' . $log_file;
		}
		wp_die();
	}

	/**
	 * Register the Menu Page.
	 *
	 * @since    1.0.0
	 */
	public function add_menu_page()
	{
		add_submenu_page('edit.php?post_type=tix_ticket', __('Generate Coupons', 'ccg'), __('Generate Coupons', 'ccg'), 'manage_options', 'camptix-generate-coupons', array($this, 'generate_coupons_page'));
	}

	/**
	 * Render the Menu Page for Coupon Generation.
	 *
	 * @since    1.0.0
	 */
	public function generate_coupons_page()
	{

		// Handle coupon generation if form is submitted
		if (isset($_POST['generate_coupons'], $_FILES['coupons_file'])) {
			$this->generate_coupons_from_file($_FILES['coupons_file']['tmp_name']);
		}

		// Output HTML for the page
		?>
		<div class="wrap">
			<h1>Generate Coupons</h1>
			<form method="post" enctype="multipart/form-data">
				<p>
					<label for="coupons_file">CSV File:</label>
					<input type="file" name="coupons_file" id="coupons_file">
				</p>
				<p>
					<input type="submit" name="generate_coupons" value="Generate Coupons" class="button button-primary">
				</p>
			</form>
			<?php if (file_exists(WP_CONTENT_DIR . '/' . LOG_FILE_NAME)) { ?>
				<?php
				$last_time = filemtime(WP_CONTENT_DIR . '/' . LOG_FILE_NAME);
				echo 'Last run was on ' . date('F d, Y H:i A', $last_time);
				?>
				<p>
					<a id="ccg_log_display" href="#" class="button">View Log</a>
				</p>
				<p id="ccg_log_content"></p>
				<p><a id="ccg_log_download" href="<?php echo '/wp-content/' . LOG_FILE_NAME ?>" class="button" donwload>Download Log</a></p>
			<?php } ?>
		</div>
<?php
	}

	/**
	 * Generate coupons from a CSV file.
	 *
	 * @param string $file The path to the CSV file.
	 * @since 1.0.0
	 */
	public function generate_coupons_from_file($file)
	{
		// Check that the file exists.
		if (!file_exists($file)) {
			wp_die('File not found.');
		}

		// Open the file.
		$handle = fopen($file, 'r');
		if (!$handle) {
			wp_die('Error opening file.');
		}

		// Read the header row and get the column names.
		$header = fgetcsv($handle);
		$columns = array_combine($header, range(0, count($header) - 1));

		// Check that the required columns are present.
		$required_columns = array('code', 'quantity');
		foreach ($required_columns as $required_column) {
			if (!isset($columns[$required_column])) {
				wp_die("Missing required column: $required_column");
			}
		}

		// Create/Wipe the log file
		$log_file = WP_CONTENT_DIR . '/' . LOG_FILE_NAME;
		fopen($log_file, 'w');

		// Generate coupons from data rows.
		while ($row = fgetcsv($handle)) {
			// Get coupon data from the row.
			$code = $row[$columns['code']];
			$discount_price = $row[$columns['discount_price']] ?? null;
			$percent = $row[$columns['discount_percent']] ?? null;
			$quantity = $row[$columns['quantity']];
			$email = $row[$columns['email']];

			// Check if the coupon already exists.
			$existing_coupon = get_posts(array(
				'post_type' => 'tix_coupon',
				'meta_key' => 'tix_code',
				'meta_value' => $code,
				'posts_per_page' => 1,
			));

			// Create coupon if it doesn't exist.
			if (!$existing_coupon) {
				$coupon_id = wp_insert_post(array(
					'post_type' => 'tix_coupon',
					'post_title' => $code,
					'post_status' => 'publish',
				));

				// Set coupon meta.
				update_post_meta($coupon_id, 'tix_code', $code);
				if ($discount_price) update_post_meta($coupon_id, 'tix_discount_price', $discount_price);
				if ($percent) update_post_meta($coupon_id, 'tix_discount_percent', $percent);
				update_post_meta($coupon_id, 'tix_coupon_quantity', $quantity);

				// Send out email.
				if ($row[$columns['email']]) {
					$subject = 'Coupon generated';
					$message = "Coupon code: $code\nDiscount price: $discount_price\nDiscount percent: $percent\nQuantity: $quantity";
					$headers = array('Content-Type: text/html; charset=UTF-8');
					$email_sent = wp_mail($email, $subject, $message, $headers);
				} else {
					$email_sent = false;
				}
				// Log successful coupon creation.
				$this->log_coupon_creation($code, true, $email, $email_sent);
			} else {
				// Log failed/skipped coupon creation.
				$this->log_coupon_creation($code, false, $email, false);
			}
		}

		// Close the file.
		fclose($handle);
	}

	/**
	 * Logs the coupon creation process.
	 *
	 * @param string $code The coupon code.
	 * @param bool $created Whether the coupon was created or not.
	 * @param bool $email_sent Whether the email was sent or not.
	 * @since 1.0.0
	 */
	public function log_coupon_creation($code, $created, $email_address, $email_sent)
	{
		// Get the log file path.
		$log_file = WP_CONTENT_DIR . '/' . LOG_FILE_NAME;
		// Log the coupon creation.
		$log_data = date('F d Y H:i A') . "," . $code . "," . ($created ? "created" : "already exists") . "," . $email_address . "," . ($email_sent ? "sent" : "not sent") . "\n";
		// Write the log data to the log file.
		file_put_contents($log_file, $log_data, FILE_APPEND);
	}
}
