<?php
declare(strict_types=1);

use Dotenv\Dotenv;
use Kristos80\Env\Env;
use Kristos80\Version\Version;
use PHPUnit\Framework\TestCase;

final class EnvTest extends TestCase {

	/**
	 * @var bool
	 */
	protected static bool $envLoaded = FALSE;

	/**
	 * @return void
	 */
	public function testAll(): void {
		$this->assertEquals("production", Env::getEnvironment());
		$this->assertEquals("sample_application", Env::getApplicationName());
		$this->assertTrue(Env::isProduction());
		$this->assertNull(Env::getSecret());
		$this->assertNull(Env::getPort());
		$this->assertNull(Env::getTimezone());
		self::loadEnv();
		$this->assertEquals("testing", Env::getEnvironment());
		$this->assertEquals("my_app", Env::getApplicationName());
		$this->assertEquals("super_secret", Env::getSecret());
		$this->assertEquals("Europe/Athens", Env::getTimezone());
	}

	/**
	 * @return void
	 */
	protected function loadEnv(): void {
		if(self::$envLoaded) {
			return;
		}

		$dotEnv = Dotenv::createImmutable(__DIR__, ".env.test");
		$dotEnv->load();
	}
}
