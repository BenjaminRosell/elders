<?php

class SettingsControllerTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', 'settings');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		$response = $this->call('GET', 'settings/1');
		$this->assertTrue($response->isOk());
	}

	public function testCreate()
	{
		$response = $this->call('GET', 'settings/create');
		$this->assertTrue($response->isOk());
	}

	public function testEdit()
	{
		$response = $this->call('GET', 'settings/1/edit');
		$this->assertTrue($response->isOk());
	}
}
