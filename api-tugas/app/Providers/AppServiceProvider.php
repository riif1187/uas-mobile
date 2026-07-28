<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Permission;

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
        // 1. Admin Bypass: Admin can do anything
        Gate::before(function (User $user) {
            if ($user->hasRole('superadmin') || $user->hasRole('administrator') || $user->hasRole('admin')) {
                return true;
            }
        });

        // 2. Dynamic Permission Checking
        try {
            if (app()->runningInConsole() === false || app()->runningUnitTests()) {
                if (\Schema::hasTable('permissions')) {
                    Permission::all()->each(function ($permission) {
                        Gate::define($permission->modul . '.' . $permission->aksi, function (User $user) use ($permission) {
                            return $user->hasPermission($permission->modul, $permission->aksi);
                        });
                    });
                }
            }
        } catch (\Exception $e) {
            // Table might not exist yet during migration
        }

        // 3. Global Check Permission Gate
        Gate::define('check-permission', function (User $user, $modul, $aksi) {
            return $user->hasPermission($modul, $aksi);
        });
    }
}
