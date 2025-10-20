<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
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
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/{$token}?email={$notifiable->getEmailForPasswordReset()}";
        });

        Gate::define('pode-operar-na-unidade', function ($user, $unidadeEmpresaId) {
            
            $permissao = DB::table('usuario_unidade')
                            ->where('usuario_id', $user->id)
                            ->where('unidade_empresa_id', $unidadeEmpresaId)
                            ->first();

            if (!$permissao) {
                return false;
            }

            return $permissao->permissao_id >= 2;
        });

        Gate::define('eh-gestor-da-unidade', function ($user, $unidadeEmpresaId) {
            $permissao = DB::table('usuario_unidade')
                            ->where('usuario_id', $user->id)
                            ->where('unidade_empresa_id', $unidadeEmpresaId)
                            ->first();

            if (!$permissao) {
                return false;
            }
            
            return $permissao->permissao_id == 3;
        });
    }
}