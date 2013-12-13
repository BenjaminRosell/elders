
<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

<<<<<<< HEAD
    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
    	$unitTesting = true;
=======
	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;
>>>>>>> 85f096b5d72b603c50462b406cd588a8dbf823ac

	$testEnvironment = 'testing';

	return require __DIR__.'/../../bootstrap/start.php';
    }

    public function tearDown(){
        Mockery::close();
    }
}
