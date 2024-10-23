<?php
/**
 * @package wp-travel-downloads-custom
 */

if (! defined('ABSPATH')) {
	exit;
}


// Remove the original callback
// remove_action('init', array('WP_Travel_Downloads_Core', 'wp_travel_itinerary_downloads_callback'), 20);

// Add your custom callback
add_action('init', 'custom_wp_travel_itinerary_downloads_callback', 20);
//remove_action('init', 'wp_travel_itinerary_downloads_callback', 10);

function custom_wp_travel_itinerary_downloads_callback()
{
	if (class_exists('WP_Travel_Downloads_Core')) {
		remove_action('init', 'wp_travel_itinerary_downloads_callback', 10);
		// Create your custom class extending WP_Travel_Downloads_Core
		class Custom_WP_Travel_Downloads extends WP_Travel_Downloads_Core {
			public static function custom_wp_travel_itinerary_download_template($trip_id, $template = 'default')
			{
				error_log(__DIR__ . '/pdf_template.php');
				include __DIR__ . '/pdf_template.php';
			}
	
			// Override the generate_pdf method here as before
			public static function generate_pdf($trip_id, $download_pdf = true)
			{
				// $trip_id = $_REQUEST['trip_id'];
				$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
				$font_dirs     = $defaultConfig['fontDir'];
	
				$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
				$fontData          = $defaultFontConfig['fontdata'];

				$mpdf = new \Mpdf\Mpdf(
					array(
						'margin_top'    => 0,
						'margin_left'   => 0,
						'margin_bottom' => 0,
						'margin_right'  => 0,
						'tempDir'       => WP_TRAVEL_ITINERARY_TMP_PATH,
						'fontdata'      => array(
							'open-sans' => array(
								'R' => 'Poppins-Regular.ttf',
								'B' => 'Poppins-Bold.ttf',
								// 'I'  => 'OpenSans-Italic.ttf',
								// 'BI' => 'OpenSans-BoldItalic.ttf',
							),
						),
						'fontDir'       => array_merge(
							$font_dirs,
							array(
								__DIR__ . '/fonts',
							)
						),
					)
				);
				ob_start();
				self::custom_wp_travel_itinerary_download_template($trip_id);
				$html = ob_get_contents();

				error_log('>>>>generate_pdf html');
				echo ($html);

				ob_end_clean();
				// echo $html;die;
				$mpdf->AddPage();
				/**
				 * @since 5.5
				 * fixed download using chinies lan
				 */
				$site_languages = get_locale();
				if ($site_languages == 'zh_CN' || $site_languages == 'zh_TW' || $site_languages == 'ja' || $site_languages == 'zh_HK') {
					$mpdf->useAdobeCJK      = true;
					$mpdf->autoLangToFont   = true;
					$mpdf->autoScriptToLang = true;
				}
				$mpdf->WriteHTML($html);
				$dir = trailingslashit(WP_TRAVEL_ITINERARY_PATH);
	
				$trips_name            = get_the_title($trip_id);
				$downloadable_filename = $trips_name . '.pdf';
				if (! $download_pdf) {
					$mpdf->Output($dir . $downloadable_filename, 'F'); // Store it in file.
				} else {
					$mpdf->Output($trips_name . '.pdf', 'D'); // download pdf.
				}
			}
		}
	
		// Initialize your custom class
		add_action('init', function () { Custom_WP_Travel_Downloads::instance(); });
	}
	
	
	// Check nonce for security
	if (! WP_Travel::verify_nonce(true)) {
		return;
	}

	// Check if the download itinerary request is set
	if (! isset($_REQUEST['download_itinerary']) || ! isset($_REQUEST['trip_id'])) {
		return;
	}

	// Your custom logic before generating the PDF
	$trip_id = $_REQUEST['trip_id'];

	
	// Call the overridden generate_pdf method or any custom logic
	Custom_WP_Travel_Downloads::generate_pdf($trip_id); // Use your custom class here

}

