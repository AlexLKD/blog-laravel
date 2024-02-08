<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Articles;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Articles::class => ArticlePolicy::class,
    ];
    
    public function boot()
    {
        $this->registerPolicies();
    }
}
