<?php namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->composeSidebar();
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


	/**
	 * This function create sidebar for theme along with
	 * getting recent person list from cache for current user
	 *
	 */

	private function composeSidebar()
    {

		view()->composer('partials/sidebar',function($view){
            $recent_viewed_persons_arr=array();

            if(Cache::has('recent_viewed_persons_' . Auth::user()->id))
			{
				$recent_viewed_persons_arr=Cache::get('recent_viewed_persons_' . Auth::user()->id);
			}

			$view->with('recent_viewed_persons_arr',$recent_viewed_persons_arr);
        });

    }
}
