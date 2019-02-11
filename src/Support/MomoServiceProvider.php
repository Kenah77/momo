<?php

namespace Momo\Support;

use Illuminate\Support\ServiceProvider;

class MomoServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap app
	 */
	public function boot()
    {
        $this->registerPublishing();
    }
    
    /**
     * Publish assets and config
     */
    private function registerPublishing()
    {
    	$this->publishes([
                __DIR__.'../../config/momo.php' => config_path('momo.php'),
            ], 'momo-config');
        }
    }

	/**
	 * Register Package Configuration
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__."/../../config/momo.php", 'momo'
		);
	}
}