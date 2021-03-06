<?php
namespace Aelia\WC\EU_VAT_Assistant\Validation;
if(!defined('ABSPATH')) { exit; } // Exit if accessed directly

use \Aelia\WC\EU_VAT_Assistant\WC_Aelia_EU_VAT_Assistant;
use \Aelia\WC\EU_VAT_Assistant\Definitions;

interface IVAT_Number_Validator {
	public static function factory();
	public static function get_supported_countries();
	public function get_errors();
	public function parse_vat_number($vat_number);
	public function get_vat_prefix($country);
	public function validate_vat_number($country, $vat_number, $requester_country = null, $requester_vat_number = null);
}

/**
 * Base class to implement a VAT Number validator.
 *
 * @since 1.15.0.201119
 */
abstract class VAT_Number_Validator implements IVAT_Number_Validator {
	use \Aelia\WC\Traits\Singleton;
	use \Aelia\WC\EU_VAT_Assistant\Traits\Logger_Trait;

	/**
	 * Identifies the validator, to distinguish between the ones used for
	 * different countries.
	 *
	 * @var string
	 */
	public static $id = 'base-validator';

	/**
	 * An associative array of country code => VAT prefix pairs.
	 *
	 * @var array
	 */
	protected $vat_country_prefixes = array();

	/**
	 * The errors generated by the class.
	 * @var array
	 */
	protected $errors = array();

	/**
	 * The VAT prefix that will be passed for validation.
	 * @var string
	 */
	protected $vat_prefix;

	/**
	 * The VAT number that will be passed for validation.
	 * @var string
	 */
	protected $vat_number;

	/**
	 * The requester VAT prefix that will be passed for validation.
	 * @var string
	 * @since 1.10.1.191108
	 */
	protected $requester_vat_prefix;

	/**
	 * The requester VAT number that will be passed for validation.
	 * @var string
	 * @since 1.10.1.191108
	 */
	protected $requester_vat_number;

	// @var bool Indicates if debug mode is active.
	protected $debug_mode;

	// @vat string The minimum length of an EU VAT number.
	// @since 1.9.7.190221
	const MIN_VAT_NUMBER_LENGTH = 8;

	/**
	 * Returns the list of contries supported by the instance of the validator.
	 *
	 * @return array
	 * @since 1.15.0.201119
	 */
	public abstract static function get_supported_countries();

	/**
	 * Factory method.
	 */
	public static function factory() {
		return new static();
	}

	/**
	 * Constructor.
	 */
	public function __construct()	{
		// This method has been left empty deliberately, so that descendants
		// can call it as parent::__construct(). This will allow to write
		// addons with such call, without having to add it later if this base
		// class will change
	}

	/**
	 * Returns a list of errors occurred during the validation of a VAT number.
	 *
	 * @return array
	 */
	public function get_errors() {
		return $this->errors;
	}

	/**
	 * Returns sn associative array of country code => VAT number prefix pairs.
	 *
	 * @return array
	 */
	protected function get_vat_country_prefixes() {
		// Allow 3rd parties to alter the prefixes
		// @since 1.15.0.201119
		return apply_filters('wc_aelia_euva_' . static::$id . '_vat_country_prefixes', $this->vat_country_prefixes);
	}

	/**
	 * Parses a VAT number, removing special characters and the country prefix, if
	 * any.
	 *
	 * @param string $vat_number
	 * @return string
	 */
	public function parse_vat_number($vat_number) {
		// Remove special characters
		$vat_number = strtoupper(str_replace(array(' ', '-', '_', '.'), '', $vat_number));

		// Remove country code if set at the begining
		$prefix = substr($vat_number, 0, 2);
		if(in_array($prefix, array_values($this->get_vat_country_prefixes()))) {
			$vat_number = substr($vat_number, 2);
		}
		if(empty($vat_number)) {
			return false;
		}
		return $vat_number;
	}

	/**
	 * Returns the VAT prefix used by a specific country.
	 *
	 * @param string country A country code.
	 * @return string|false
	 */
	public function get_vat_prefix($country) {
		$country_prefixes = $this->get_vat_country_prefixes();
		return $country_prefixes[$country] ?? false;
	}

	/**
	 * Returns the key used to store and fetch cached validation results.
	 *
	 * @param string $vat_prefix
	 * @param string $vat_number
	 * @return string
	 * @since 1.15.0.201119
	 */
	protected function get_vat_number_validation_cache_key($vat_prefix, $vat_number) {
		return implode('_', array(
			Definitions::TRANSIENT_VAT_NUMBER_VALIDATION_RESULT,
			static::$id,
			$vat_prefix,
			$vat_number
		));
	}

	/**
	 * Caches the validation result of a VAT number for a limited period of time.
	 * This will improve performances when customers will place new orders in a
	 * short timeframe, by reducing the amount of calls to the VIES service.
	 *
	 * @param string vat_prefix The VAT prefix.
	 * @param string vat_number The VAT number.
	 * @param array result The validation result.
	 */
	protected function cache_validation_result($vat_prefix, $vat_number, $result) {
		set_transient($this->get_vat_number_validation_cache_key($vat_prefix, $vat_number),
									$result, apply_filters('wc_aelia_euva_vat_validation_cache_duration', 1 * HOUR_IN_SECONDS, $vat_prefix, $vat_number, $result));
	}

	/**
	 * Returns the cached result of a VAT number validation, if it exists.
	 *
	 * @param string vat_prefix The VAT prefix.
	 * @param string vat_number The VAT number.
	 * @return array|bool An array with the validatin result, or false if a cached
	 * result was not found.
	 */
	protected function get_cached_validation_result($vat_prefix, $vat_number) {
		// In debug mode, behave as if nothing was cached
		if(self::debug_mode()) {
			return false;
		}
		return get_transient($this->get_vat_number_validation_cache_key($vat_prefix, $vat_number));
	}

	/**
	 * Returns the minimum lengths of VAT numbers for the countries supported by this validator.
	 *
	 * @return array
	 * @since 1.15.0.201119
	 */
	protected abstract function get_countries_vat_number_min_lengths();

	/**
	 * Returns the minimum length of a VAT number for a given country.
	 *
	 * @param string $country
	 * @return int
	 * @since 1.15.0.201119
	 */
	protected function get_minimum_vat_number_length($country) {
		// Fetch the minimum lengths of VAT numbers for the countries supported
		// by thid validator
		$min_lengths = $this->get_countries_vat_number_min_lengths();

		return apply_filters('wc_aelia_euva_min_vat_number_length', $min_lengths[$country] ?? static::MIN_VAT_NUMBER_LENGTH, $country, $this);
	}

	/**
	 * Validates the argument passed for validation, transforming a countr code
	 * into a VAT prefix and checking the VAT number before it's used for a VIES
	 * request.
	 *
	 * @param string country A country code. It will be used to determine the VAT
	 * number prefix.
	 * @param string vat_number A VAT number.
	 * @param string requester_country The country code of the requester.
	 * @param string requester_vat_number The VAT number of the requester.
	 * @return bool
	 */
	protected function prepare_request_arguments($country, $vat_number, $requester_country = null, $requester_vat_number = null) {
		// Some preliminary formal validation, to prevent unnecessary requests with
		// clearly invalid data
		$this->vat_number = $this->parse_vat_number($vat_number);
		if(empty($this->vat_number)) {
			$this->errors[] = implode(' ', array(
				__('An empty or invalid VAT number was passed for validation.', Definitions::TEXT_DOMAIN),
				sprintf(__('Received VAT number: "%1$s".', Definitions::TEXT_DOMAIN), $vat_number),
			));
		}

		// Get the minimum length expected for a EU VAT number for customer's country
		// @since 1.12.6.200212
		$min_vat_number_length = $this->get_minimum_vat_number_length($country);
		// If the VAT number includes the country code at the beginning,
		// the minimum length should be increased, as those two characters
		// don't count
		if(substr($this->vat_number, 0, 2) === $country) {
			$min_vat_number_length += 2;
		}

		// Don't validate VAT numbers that are too short, as they would be invalid anyway
		// @since 1.9.7.190221
		if(strlen($this->vat_number) < $min_vat_number_length) {
			$this->errors[] = sprintf(__('An invalid VAT number was passed for validation. ' .
																	 'A VAT number for country "%1$s" should contain a minimum of %2$d digits, excluding the ' .
																	 'country prefix. Received VAT number: "%3$s".',
																	 Definitions::TEXT_DOMAIN),
																$country,
																$min_vat_number_length,
																$vat_number);
		}

		// Validate the country prefix for the VAT number
		$this->vat_prefix = $this->get_vat_prefix($country);
		if(empty($this->vat_prefix)) {
			$this->errors[] = sprintf(__('A VAT prefix could not be found for the specified country. ' .
																	 'Received country code: "%s".',
																	 Definitions::TEXT_DOMAIN),
																$country);
		}

		// Validate the requester VAT number
		// @since 1.10.1.191108
		$this->requester_vat_prefix = '';
		$this->requester_vat_number = '';
		$requester_vat_number_valid = true;

		if(!empty($requester_vat_number)) {
			// Get the minimum length expected for a EU VAT number for merchant's country
			// @since 1.12.6.200212
			$min_vat_number_length = $this->get_minimum_vat_number_length($requester_country);

			$this->requester_vat_number = $requester_vat_number;
			// If the VAT number includes the country code at the beginning,
			// the minimum length should be increased, as those two characters
			// don't count
			if(substr($this->requester_vat_number, 0, 2) === $requester_country) {
				$min_vat_number_length += 2;
			}

			// Don't validate VAT numbers that are too short, as they would be invalid anyway
			if(strlen($this->requester_vat_number) < $min_vat_number_length) {
				self::get_logger()->warning(implode(' ', array(
					__('The requester VAT number configured in the VAT Number Validation settings is too short.', Definitions::TEXT_DOMAIN),
					sprintf(__('A VAT number for country "%1$s" should contain a minimum of %2$d digits, excluding the country prefix.',Definitions::TEXT_DOMAIN), $requester_country, $min_vat_number_length),
					sprintf(__('Requester VAT number: "%1$s".', Definitions::TEXT_DOMAIN), $requester_vat_number),
				)));

				$requester_vat_number_valid = false;
			}

			// Validate the requester VAT number prefix
			// @since 1.10.1.191108
			if($requester_vat_number_valid && !empty($requester_country)) {
				// Validate the country prefix for the requester VAT number
				$this->requester_vat_prefix = $this->get_vat_prefix($requester_country);
				if(empty($this->requester_vat_prefix)) {
					self::get_logger()->warning(implode(' ', array(
						__('A VAT prefix could not be found for the requester country.', Definitions::TEXT_DOMAIN),
						sprintf(__('Requester country code: "%1$s".', Definitions::TEXT_DOMAIN), $requester_country),
					)));

					$requester_vat_number_valid = false;
				}
			}

			// Ignore the requester VAT number if it's not valid. This will allow the
			// request to the VIES system to go through without it
			// @since 1.10.1.191108
			if(!$requester_vat_number_valid) {
				$this->requester_vat_prefix = '';
				$this->requester_vat_number = '';

				self::get_logger()->warning(__('Requester VAT number is not valid. Performing validation without it.', Definitions::TEXT_DOMAIN), array(
					'Requester Country' => $requester_country,
					'Requester VAT Number' => $requester_vat_number,
				));
			}
		}

		// Log all the error messages that occurred during the validation
		// @since 1.9.7.190221
		foreach($this->errors as $error_message) {
			self::get_logger()->info($error_message);
		}

		return empty($this->errors);
	}

	/**
	 * Checks if a cached response is valid. In some older versions, an incorrect
	 * response was cached and, when returned, caused the plugin to consider invalid
	 * numbers that were actually valid.
	 *
	 * @param mixed $response The cached response.
	 * @return bool
	 */
	protected function valid_cached_response($response) {
		return ($response !== false) &&
					 is_array($response) &&
					 ($response['valid'] ?? null == 'true');
	}

	/**
	 * Validates a VAT number and returns a response with the result of the validation.
	 *
	 * @param string $country
	 * @param string $vat_number
	 * @param string $requester_country
	 * @param string $requester_vat_number
	 * @return array
	 * @since 1.15.0.201119
	 */
	protected abstract function perform_vat_number_validation($country, $vat_number, $requester_country = null, $requester_vat_number = null);

	/**
	 * Validates a VAT number.
	 *
	 * @param string country The country code to which the VAT number belongs.
	 * @param string vat_number The VAT number to validate.
	 * @param string requester_country The country code of the requester.
	 * @param string requester_vat_number The VAT number of the requester.
	 * @return array|bool An array with the validation response returned by the
	 * VIES service, or false when the request could not be sent for some reason.
	 * @link https://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl
	 */
	public function validate_vat_number($country, $vat_number, $requester_country = null, $requester_vat_number = null) {
		$this->errors = array();

		// Remove the country prefix from the VAT numbers, if such value is present. This is necessary because some
		// services can't handle VAT numbers with a prefix
		// @since 2.0.2.201221
		$vat_number = $this->parse_vat_number($vat_number);
		$requester_vat_number = $this->parse_vat_number($requester_vat_number);

		// The arguments must be prepared (e.g. length checked, country prefix added, etc) before sending the request
		// and before checking if a cached result exists
		// @since 1.10.1.191108
		if(!$this->prepare_request_arguments($country, $vat_number, $requester_country, $requester_vat_number)) {
			return array(
				'valid' => false,
				'errors' => array(Definitions::VAT_NUMBER_COULD_NOT_BE_VALIDATED),
				'raw_response' => null,
			);
		}

		// Return a cached response, if one exists. Faster than sending a SOAP request.
		$cached_response = $this->get_cached_validation_result($this->vat_prefix, $this->vat_number);
		if($this->valid_cached_response($cached_response)) {
			return $cached_response;
		}

		// Validate the VAT number, calling any remote service
		// @since 1.15.0.201119
		$response = $this->perform_vat_number_validation($country, $vat_number, $requester_country, $requester_vat_number);

		if(!is_array($response)) {
			$response = array(
				'valid' => null,
				'company_name' => null,
				'company_address' => null,
				'errors' => $this->get_errors(),
				'raw_response' => null,
				'validation_source' => '',
			);
		}

		// Cache response for valid VAT numbers
		if($response['valid'] && !self::debug_mode()) {
			$this->cache_validation_result($this->vat_prefix, $this->vat_number, $response);
		}
		return $response;
	}
}
