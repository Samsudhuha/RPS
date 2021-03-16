<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ProgramStudiRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\JurusanRepository;
use App\Repositories\EloquentProgramStudiRepository;
use App\Repositories\EloquentUsersRepository;
use App\Repositories\EloquentJurusanRepository;

class RpsServiceProvider extends ServiceProvider
{
    public $bindings = [
        ProgramStudiRepository::class => EloquentProgramStudiRepository::class,
        UserRepository::class => EloquentUsersRepository::class,
        JurusanRepository::class => EloquentjurusanRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
