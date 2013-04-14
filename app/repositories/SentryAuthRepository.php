<?php 

class SentryAuthRepository implements AuthInterface
{
	public function getUser()
	{
		return Sentry::getUser();
	}
}