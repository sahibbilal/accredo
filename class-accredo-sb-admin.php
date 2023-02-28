<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://maxenius.com/
 * @since      1.0
 *
 * @package    WTS_BOOKING_CENTER
 * @subpackage WTS_BOOKING_CENTER/admin
 */
class ACCREDO_SB_Admin {

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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name  = $plugin_name;
		$this->version      = $version;

    }
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

//        wp_enqueue_style( $this->plugin_name.'plugin-licensor-css', plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->version, 'all' );

	}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

        if ( ! did_action( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }
//        wp_enqueue_script( $this->plugin_name.'plugin-licensor-js-datatable',   plugin_dir_url( __FILE__ ) . 'js/datatable.js', array( 'jquery', 'wp-color-picker' ), $this->version, true );
//        wp_localize_script( $this->plugin_name.'plugin-licensor-js', 'wts_bc_ajax_url', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}


    /**
     * Crone job time.
     *
     * @since    1.0.0
     */
    public function accredo_sb_car_feed( $schedules ) {
        $schedules['tenminute'] = array(
            'display' => __( 'Every 10 minute', 'woocommerce' ),
            'interval' => 600,
        );
        $schedules['thirtyminute'] = array(
            'display' => __( 'Every 30 minute', 'woocommerce' ),
            'interval' => 1800,
        );
        $schedules['onehour'] = array(
            'display' => __( 'Every 1 Hour', 'woocommerce' ),
            'interval' => 3600,
        );
        $schedules['daily'] = array(
            'display' => __( 'Every Day', 'woocommerce' ),
            'interval' => 36000,
        );
        $schedules['fifteendays'] = array(
            'display' => __( 'Every 15 Days', 'woocommerce' ),
            'interval' => 1296000,
        );
        $schedules['monthly'] = array(
            'display' => __( 'Monthly', 'woocommerce' ),
            'interval' => 2592000 ,
        );
        return $schedules;
    }

    /**
     * Schedule Cron Job Event Account 1
     *
     * @since    1.0.0
     */
    public function accredo_sb_get_shedule_car_feed() {

        $schedules = get_option('wts_cron_time');
        if ( ! wp_next_scheduled( 'accredo_sb_get_reshedule' ) ) {
            wp_schedule_event( time(), $schedules ,   'accredo_sb_get_reshedule' );
        }

    }
    /**
     * Schedule Cron Job Event account 1
     *
     * @since    1.0.0
     */
    public function accredo_sb_get_reshedule_callback() {

        $url            = 'https://sandbox.bsnfittings.co.nz:6569/mercury/oauth2/v1/token';
        $access_token   = $this->accredo_sb_curl_call($url, 'token');
//        if($access_token->error == 'invalid_request'){
//            print_r($access_token);
//        }
//        else {
            $url = "https://sandbox.bsnfittings.co.nz:6569//mercury/odata4/v1/Company('M0732002')/ICProduct?access_token=qiqHhqosdloPKg_L";
            $products = $this->accredo_sb_curl_call($url, 'products');
            foreach ($products->value as $single) {
                $this->accredo_sb_insert_products($single);
            }
//        }
    }
    public function accredo_sb_get_reshedule_callback1() {
		
		$host= '202.27.212.132';
$user = 'IntercorpLtd';
$password = 'Friday20May2022';
$ftpConn = ftp_connect($host);
$login = ftp_login($ftpConn,$user,$password);
// check connection
if ((!$ftpConn) || (!$login)) {
 echo 'FTP connection has failed! Attempted to connect to '. $host. ' for user '.$user.'.';
} else{
 echo 'FTP connection was a success.';
 $directory = ftp_nlist($ftpConn,'');
 echo '<pre>'.print_r($directory, true).'</pre>';
}
ftp_close($ftpConn);
return true;		
      //  $connection = ssh2_connect('202.27.212.132', 21);
       // ssh2_auth_password($connection, 'IntercorpLtd', 'Friday20May2022');
//        $sftp_fd = intval($sftp);

        $host      = '202.27.212.132';
        $port      = 21;
        $username  = 'IntercorpLtd';
        $password  = 'Friday20May2022';
        $path      = '.';
        $recursive = true;

        $conn = new SB_SFTP($host, $port);
        $conn->login($username, $password);
        $files = $conn->ls($path, $recursive);
        echo '<pre>';
        print_r($files);

        die();
        try
        {
            $sftp = new SFTPConnection("bsnubt.sftp.wpengine.com", 2222);
            $sftp->login("bsnubt", "farooq6687599");
            $sftp->uploadFile("/tmp/to_be_sent", "/tmp/to_be_received");
        }
        catch (Exception $e)
        {
            echo $e->getMessage() . "\n";
        }
        die();

//        $uri = "202.27.212.132:21";
        $port = 21;
        $username = "IntercorpLtd";
        $password = "Friday20May2022";
//        $username   = 'openseastaking@openseastaking.com';
//        $password   = 'openseastaking';
//        $uri        = 'ftp.openseastaking.com';
        $username   = 'bsnubt';
        $password   = 'farooq6687599';
        $uri        = 'bsnubt.sftp.wpengine.com';
        $path       = "/IC Products/EFJCL Joint Clamp L-Shape HDG.PNG";
        $path       = "https://openseastaking.com/wp-content/uploads/2022/06/1.jpg";
        $ftp_conn   = ftp_ssl_connect($uri) or die("Could not connect to $uri");

        if (@ftp_login($ftp_conn, $username, $password))
        {
            echo "Connection established.<br />";
            ftp_pasv($ftp_conn, true);

            $contents = ftp_nlist($ftp_conn, ".");
            echo '<pre>';
            print_r($contents);
        }
        else
        {
            echo "Couldn't establish a connection.";
        }
        ftp_close($ftp_conn);
        die();;
    }
    /**
     * Get access token and product by curl call
     *
     * @since    1.0.0
     */

    public function accredo_sb_curl_call($url, $type){
        $params = array(
            "grant_type" => get_option('wts_grant_type'),
            "client_id" => get_option('wts_client_id'),
            "username" => get_option('wts_username'),
            "password" => get_option('wts_password')
        );

        $params = json_encode($params);
        $ch = curl_init($url);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        if($type == 'token') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        return $response;
    }

    /**
     * Insert Product
     *
     * @since    1.0.0
     */
    public function accredo_sb_insert_products($single){
        global $wpdb;
        $page   = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = $single->ProductCode AND post_type= 'product'" ) );
        $price  = 0;
        $price = (!empty($single->StandardCost)) ? $single->StandardCost : '';
        $price = (empty($price)) ? $single->LatestCost : '';
        $price = (empty($price)) ? $single->AverageCost : '';

        if( empty($page) && !empty($price) && $price != 0 ){
            $term = get_term_by( 'name', $single->Category2, 'product_cat' );
            $term_id = 0;
            if(!empty($term) && isset($term->name) && !empty($term->name)){
                $term_id = $term->term_id;
            }
            else{
                $new_cat_added = wp_insert_term( $single->Category2, 'product_cat' );
                $term_id = $new_cat_added['term_id'];
            }

            $image = 'https://yoohooplugins.com/wp-content/uploads/2021/03/create-woocommerce-product-programmatically-1080x675.jpg';
            $attach_id  = (!empty($single->ImagePath)) ? $this->max_upload_featured_image($image) : '';
            $product    = new WC_Product_Simple();
            $product->set_name( $single->ProductCode );
            $product->set_status( 'publish' );
            $product->set_price( $single->StandardCost );
            $product->set_regular_price( $single->StandardCost );
            $product->set_sale_price( $single->StandardCost );
            $product->set_description( $single->Description );
            $product->set_sku( 'accredo-'.rand(10,100000000) );
            $product->set_image_id( $attach_id );
            $product->save();
            $id = $product->get_id();
            wp_set_object_terms( $id, $term_id, 'product_cat' );
        }

    }



    /**
     * Upload Product Image
     *
     * @since    1.0.0
     */

    public function max_upload_featured_image($link) {
        $ext =  pathinfo($link, PATHINFO_EXTENSION);
        if(strpos($ext, "?") !== false){
            $ext = explode('?',$ext)[0];
        }
        $image_url        = $link;
        $image_name       = 'wts-'.rand(10,1000000000).'-sb.'.$ext;
        $upload_dir       = wp_upload_dir(); // Set upload folder
        $image_data       = file_get_contents($image_url); // Get image data
        $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
        $filename         = basename( $unique_file_name ); // Create image file name
        if( wp_mkdir_p( $upload_dir['path'] ) ) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }
        file_put_contents( $file, $image_data );
        $wp_filetype = wp_check_filetype( $filename, null );

        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => sanitize_file_name( $filename ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        $attach_id = wp_insert_attachment( $attachment, $file );
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

        wp_update_attachment_metadata( $attach_id, $attach_data );
        return $attach_id;
    }
    /**
     * Add a submenu item to the WooCommerce menu
     *
     * @return void
     */
    public function admin_menu()
    {
        add_menu_page(
            'Accredo',
            'Accredo',
            'manage_options',
            'accredo',
            array(
                $this,
                'accredo_options',
            ), '', 2
        );
    }
    public function register_accredo_options() {
        //register our settings
        register_setting( 'wts-accredo-options', 'wts_grant_type' );
        register_setting( 'wts-accredo-options', 'wts_client_id' );
        register_setting( 'wts-accredo-options', 'wts_username' );
        register_setting( 'wts-accredo-options', 'wts_password' );
        register_setting( 'wts-accredo-options', 'wts_cron_time' );
    }
    public function accredo_options() {
        ?>
        <h1>Accredo Options</h1>
        <div class="wrap">
            <form method="post" action="options.php">
                <?php settings_fields( 'wts-accredo-options' ); ?>
                <?php do_settings_sections( 'wts-accredo-options' ); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">Grant Type</th>
                        <td>
                            <input type="text" name="wts_grant_type" value="<?php echo esc_attr( get_option('wts_grant_type') ); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Client ID</th>
                        <td>
                            <input type="text" name="wts_client_id" value="<?php echo esc_attr( get_option('wts_client_id') ); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Username</th>
                        <td>
                            <input type="text" name="wts_username" value="<?php echo esc_attr( get_option('wts_username') ); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Password</th>
                        <td>
                            <input type="text" name="wts_password" value="<?php echo esc_attr( get_option('wts_password') ); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Cron Shedule</th>
                        <td>
                            <select id="wts_cron_time" name="wts_cron_time" value="<?php echo esc_attr( get_option('wts_cron_time') ); ?>">
                                <option value="tenminute" <?php selected( get_option('wts_cron_time'), 'tenminute' ); ?>>Ten Minutes</option>
                                <option value="thirtyminute" <?php selected( get_option('wts_cron_time'), 'thirtyminute' ); ?>>Thirty Minutes</option>
                                <option value="onehour" <?php selected( get_option('wts_cron_time'), 'onehour' ); ?>>One Hour</option>
                                <option value="daily" <?php selected( get_option('wts_cron_time'), 'daily' ); ?>>Every Day</option>
                                <option value="fifteendays" <?php selected( get_option('wts_cron_time'), 'fifteendays' ); ?>>Fifteen Days</option>
                                <option value="monthly" <?php selected( get_option('wts_cron_time'), 'monthly' ); ?>>Monthly</option>
                            </select>
                        </td>
                    </tr>
                </table>

                <?php submit_button(); ?>

            </form>
        </div>
    <?php }
}
class SFTPConnection
{
    private $connection;
    private $sftp;

    public function __construct($host, $port=22)
    {
        $this->connection = @ssh2_connect($host, $port);
        if (! $this->connection)
            throw new Exception("Could not connect to $host on port $port.");
    }

    public function login($username, $password)
    {
        if (! @ssh2_auth_password($this->connection, $username, $password))
            throw new Exception("Could not authenticate with username $username " . "and password $password.");
        $this->sftp = @ssh2_sftp($this->connection);
        if (! $this->sftp)
            throw new Exception("Could not initialize SFTP subsystem.");
    }

    public function uploadFile($local_file, $remote_file)
    {
        $sftp = $this->sftp;
        $stream = @fopen("ssh2.sftp://$sftp$remote_file", 'w');
        if (! $stream)
            throw new Exception("Could not open file: $remote_file");
        $data_to_send = @file_get_contents($local_file);
        if ($data_to_send === false)
            throw new Exception("Could not open local file: $local_file.");
        if (@fwrite($stream, $data_to_send) === false)
            throw new Exception("Could not send data from file: $local_file.");
        @fclose($stream);
    }

    function scanFilesystem($remote_file) {
        $sftp = $this->sftp;
        $dir = "ssh2.sftp://$sftp$remote_file";
        $tempArray = array();
        $handle = opendir($dir);
        // List all the files
        while (false !== ($file = readdir($handle))) {
            if (substr("$file", 0, 1) != "."){
                if(is_dir($file)){
//                $tempArray[$file] = $this->scanFilesystem("$dir/$file");
                } else {
                    $tempArray[]=$file;
                }
            }
        }
        closedir($handle);
        return $tempArray;
    }

    public function receiveFile($remote_file, $local_file)
    {
        $sftp = $this->sftp;
        $stream = @fopen("ssh2.sftp://$sftp$remote_file", 'r');
        if (! $stream)
            throw new Exception("Could not open file: $remote_file");
        $size = $this->getFileSize($remote_file);
        $contents = '';
        $read = 0;
        $len = $size;
        while ($read < $len && ($buf = fread($stream, $len - $read))) {
            $read += strlen($buf);
            $contents .= $buf;
        }
        file_put_contents ($local_file, $contents);
        @fclose($stream);
    }

    public function deleteFile($remote_file){
        $sftp = $this->sftp;
        unlink("ssh2.sftp://$sftp$remote_file");
    }
    public function getFileSize($file){
        $sftp = $this->sftp;
        return filesize("ssh2.sftp://$sftp$file");
    }
}
class SB_SFTP
{
    private $connection;
    private $sftp;

    public function __construct($host, $port = 22)
    {
        $this->connection = @ssh2_connect($host, $port);
        if (! $this->connection)
            throw new Exception("Could not connect to $host on port $port.");
    }

    public function login($username, $password)
    {
        if (! @ssh2_auth_password($this->connection, $username, $password))
            throw new Exception("Could not authenticate with username $username");
        $this->sftp = @ssh2_sftp($this->connection);
        if (! $this->sftp)
            throw new Exception("Could not initialize SFTP subsystem.");
    }

    public function ls($remote_path, $recursive = false)
    {
        $tmp      = $this->sftp;
        $sftp     = intval($tmp);
        $dir      = "ssh2.sftp://$sftp/$remote_path";
        $contents = array();
        $handle   = opendir($dir);

        while (($file = readdir($handle)) !== false) {
            if (substr("$file", 0, 1) != "."){
                if (is_dir("$dir/$file")){
                    if ($recursive) {
                        $contents[$file] = array();
                        $contents[$file] = $this->ls("$remote_path/$file", $recursive);
                    }
                } else {
                    $contents[] = $file;
                }
            }
        }

        closedir($handle);
        return $contents;
    }
}
