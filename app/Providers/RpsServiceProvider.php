<?php

namespace App\Providers;

use App\Repositories\Contracts\DosenMataKuliahRepository;
use App\Repositories\Contracts\DosenRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ProgramStudiRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\JurusanRepository;
use App\Repositories\Contracts\MataKuliahRepository;
use App\Repositories\Contracts\RmkRepository;
use App\Repositories\EloquentDosenMataKuliahRepository;
use App\Repositories\EloquentDosenRepository;
use App\Repositories\EloquentProgramStudiRepository;
use App\Repositories\EloquentUsersRepository;
use App\Repositories\EloquentJurusanRepository;
use App\Repositories\EloquentMataKuliahRepository;
use App\Repositories\EloquentRmkRepository;

class RpsServiceProvider extends ServiceProvider
{
    public $bindings = [
        ProgramStudiRepository::class => EloquentProgramStudiRepository::class,
        UserRepository::class => EloquentUsersRepository::class,
        JurusanRepository::class => EloquentjurusanRepository::class,
        MataKuliahRepository::class => EloquentMataKuliahRepository::class,
        RmkRepository::class => EloquentRmkRepository::class,
        DosenRepository::class => EloquentDosenRepository::class,
        DosenMataKuliahRepository::class => EloquentDosenMataKuliahRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
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
