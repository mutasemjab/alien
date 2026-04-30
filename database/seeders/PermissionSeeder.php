<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions_admin = [


            'role-table',
            'role-add',
            'role-edit',
            'role-delete',

            'employee-table',
            'employee-add',
            'employee-edit',
            'employee-delete',

            'user-table',
            'user-add',
            'user-edit',
            'user-delete',


            'banner-table',
            'banner-add',
            'banner-edit',
            'banner-delete',


            'service-table',
            'service-add',
            'service-edit',
            'service-delete',

            'offer-table',
            'offer-add',
            'offer-edit',
            'offer-delete',

            'testimonial-table',
            'testimonial-add',
            'testimonial-edit',
            'testimonial-delete',

            'choose-table',
            'choose-add',
            'choose-edit',
            'choose-delete',

            'category-table',
            'category-add',
            'category-edit',
            'category-delete',

            'project-table',
            'project-add',
            'project-edit',
            'project-delete',


            'website-config-table',
            'website-config-add',
            'website-config-edit',
            'website-config-delete',


        ];

         foreach ($permissions_admin as $permission_ad) {
            Permission::create(['name' => $permission_ad, 'guard_name' => 'admin']);
        }
    }
}
