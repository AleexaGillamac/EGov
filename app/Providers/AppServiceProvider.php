<?php
namespace App\Providers;

use App\Models\Office;
use App\Models\Feedback;
use App\Models\Complaint;
use App\Policies\OfficePolicy;
use App\Policies\FeedbackPolicy;
use App\Policies\ComplaintPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     *
     */
    protected $policies = [
        Office::class => OfficePolicy::class,
        Complaint::class => ComplaintPolicy::class, 
        Feedback::class => FeedbackPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     *
     */
}
