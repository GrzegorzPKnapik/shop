<?php

namespace App\Providers;

use App\Enums\RoleName;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();


        $admin_id = Role::where('name', RoleName::getAdmin())->value('id');
        $user_id = Role::where('name', RoleName::getUser())->value('id');
        $employee_id = Role::where('name', RoleName::getEmployee())->value('id');

        $this->defineUserRoleGate('isAdmin', $admin_id);
        $this->defineUserRoleGate('isUser', $user_id);
        $this->defineUserRoleGate('isEmployee', $employee_id);

    }


    private function defineUserRoleGate(string $name, string $role): void
    {
        Gate::define($name, function (User $user) use ($role)  {
            return $user->ROLES_id == $role;
        });
    }
}
