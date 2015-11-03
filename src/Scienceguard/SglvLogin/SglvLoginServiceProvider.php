<?php namespace Scienceguard\SglvLogin;

use Illuminate\Support\ServiceProvider;

class SglvLoginServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;


	/**
    * Include some specific files from the src-root.
    *
    * @return void
    */
	private function loadIncludes($files, $param='include')
	{
		// Run through $filesToLoad array.
		foreach ($files as $file) {
			// Add needed database structure and file extension.
			$file = __DIR__ . '/../../' . $file . '.php';
			// If file exists, include.
			if (is_file($file) && file_exists($file)){
				if($param=='require'){
					require_once($file);
				}
				else{
					include($file);
				}
			}
		}
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('scienceguard/sglv-login');

		// include files using require function
		$files = array(
			'form_rules',
		);
		$this->loadIncludes($files, 'require');

		// include files using include function
		$files = array(
			'events',
			'filters',
			'validations',
			'routes',
		);
		$this->loadIncludes($files, 'include');

		// artisan command
		// $this->app->bind('sglv-login::command.user.create', function($app) {
		// 	return new UserCreateCommand();
		// });
		// $this->commands(array(
		// 	'sglv-login::command.user.create'
		// ));
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
