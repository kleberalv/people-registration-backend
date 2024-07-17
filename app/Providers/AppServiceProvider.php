<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PessoaRepository;
use App\Repositories\EnderecoRepository;
use App\Services\PessoaService;
use App\Services\EnderecoService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PessoaRepository::class, function ($app) {
            return new PessoaRepository(new \App\Models\Pessoa);
        });

        $this->app->singleton(EnderecoRepository::class, function ($app) {
            return new EnderecoRepository(new \App\Models\Endereco);
        });

        $this->app->singleton(PessoaService::class, function ($app) {
            return new PessoaService($app->make(PessoaRepository::class));
        });

        $this->app->singleton(EnderecoService::class, function ($app) {
            return new EnderecoService($app->make(EnderecoRepository::class));
        });
    }

    public function boot()
    {
        //
    }
}
