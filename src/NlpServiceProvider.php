<?php 

namespace Web64\LaravelNlp;

use Illuminate\Support\ServiceProvider;
use Web64\LaravelNlp\LaravelNlp;

// php artisan vendor:publish --provider="Web64\LaravelNlp\NlpServiceProvider"

class NlpServiceProvider extends ServiceProvider 
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
    protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
    }

    /**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $app = $this->app ?: app();

        $this->mergeConfigFrom(__DIR__.'/config/nlp.php', 'nlp');

        $this->publishes([
            __DIR__.'/config/nlp.php' => config_path('nlp.php'),
        ]);

        $this->app->singleton(\Web64\LaravelNlp\LaravelNlp::class, function () use ($app) {
            $config = $app['config']->get('nlp');
            
			return new \Web64\LaravelNlp\LaravelNlp($config);
		});
    }
}