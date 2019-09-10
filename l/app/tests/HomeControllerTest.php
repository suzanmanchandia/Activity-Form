<?php

class HomeControllerTest extends TestCase {

	public function setUp()
	{
		parent::setUp();

		$this->staff = $this->mock('Staff');
	}

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	public function testLoginAction()
	{
		$this->markTestIncomplete(
			'This test has problems with backward redirect.'
		);

		$this->staff->shouldReceive('first')->once()->andReturn($this->staff);

		$this->app->instance('Staff', $this->staff);

		$this->route(
			'POST',
			'staff.login.action',
			array(),
			array(
				'email' => 'test@email.com',
				'password' => '12345',
			)
		);

		$this->assertRedirectedToRoute('form.index');
		$this->assertTrue($this->client->getResponse()->isOk());
	}

}
