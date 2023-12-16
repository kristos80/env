<?php
declare(strict_types=1);

namespace Kristos80\Env;

final class Env {

	/**
	 *
	 */
	private const ENVIRONMENT = "environment";

	/**
	 *
	 */
	private const ENVIRONMENT_VARIABLE_NAMES = [
		"APP_ENV",
		"ENV",
		"APPLICATION_ENV",
	];

	/**
	 *
	 */
	private const APPLICATION_NAME = "application_name";

	/**
	 *
	 */
	private const APPLICATION_NAME_VARIABLE_NAMES = [
		"APP_NAME",
		"APPLICATION_NAME",
		"NAME",
	];

	/**
	 *
	 */
	private const SECRET = "secret";

	/**
	 *
	 */
	private const SECRET_VARIABLE_NAMES = [
		"APP_SECRET",
		"SECRET",
		"APPLICATION_SECRET",
	];

	/**
	 *
	 */
	private const PORT = "port";

	/**
	 *
	 */
	private const PORT_VARIABLE_NAMES = [
		"APP_PORT",
		"PORT",
		"APPLICATION_PORT",
	];

	/**
	 *
	 */
	private const TIMEZONE = "timezone";

	/**
	 *
	 */
	private const TIMEZONE_VARIABLE_NAMES = [
		"APP_TIMEZONE",
		"TIMEZONE",
		"APPLICATION_TIMEZONE",
	];

	/**
	 *
	 */
	private const PRODUCTION = "production";

	/**
	 * @return bool
	 */
	public static function isProduction(): bool {
		return self::getEnvironment() === self::PRODUCTION;
	}

	/**
	 * @return string
	 */
	public static function getEnvironment(): string {
		return self::getByMode(self::ENVIRONMENT, self::PRODUCTION);
	}

	/**
	 * @param string $mode
	 * @param string|NULL $default
	 * @return string|null
	 */
	private static function getByMode(string $mode, string $default = NULL): ?string {
		$poolOfNames = [];
		switch($mode) {
			case self::ENVIRONMENT:
				$poolOfNames = self::ENVIRONMENT_VARIABLE_NAMES;
			break;
			case self::APPLICATION_NAME:
				$poolOfNames = self::APPLICATION_NAME_VARIABLE_NAMES;
			break;
			case self::SECRET:
				$poolOfNames = self::SECRET_VARIABLE_NAMES;
			break;
			case self::PORT:
				$poolOfNames = self::PORT_VARIABLE_NAMES;
			break;
			case self::TIMEZONE:
				$poolOfNames = self::TIMEZONE_VARIABLE_NAMES;
			break;
		}

		$value = NULL;
		foreach($poolOfNames as $name) {
			$value = self::get($name);
			if($value) {
				break;
			}
		}

		return $value ?? $default;
	}

	/**
	 * @param string $key
	 * @param mixed|NULL $default
	 * @return mixed
	 */
	public static function get(string $key, mixed $default = NULL): mixed {
		return ($_ENV[strtoupper($key)] ?? ($_ENV[strtolower($key)] ?? $default)) ?: $default;
	}

	/**
	 * @return string
	 */
	public static function getApplicationName(): string {
		return self::getByMode(self::APPLICATION_NAME, "sample_application");
	}

	/**
	 * @return ?string
	 */
	public static function getSecret(): ?string {
		return self::getByMode(self::SECRET);
	}

	/**
	 * @return ?string
	 */
	public static function getPort(): ?string {
		return self::getByMode(self::PORT);
	}

	/**
	 * @return ?string
	 */
	public static function getTimezone(): ?string {
		return self::getByMode(self::TIMEZONE);
	}
}
