<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'master_access',
            ],
            [
                'id'    => 18,
                'title' => 'banner_create',
            ],
            [
                'id'    => 19,
                'title' => 'banner_edit',
            ],
            [
                'id'    => 20,
                'title' => 'banner_show',
            ],
            [
                'id'    => 21,
                'title' => 'banner_delete',
            ],
            [
                'id'    => 22,
                'title' => 'banner_access',
            ],
            [
                'id'    => 23,
                'title' => 'banner_card_create',
            ],
            [
                'id'    => 24,
                'title' => 'banner_card_edit',
            ],
            [
                'id'    => 25,
                'title' => 'banner_card_show',
            ],
            [
                'id'    => 26,
                'title' => 'banner_card_delete',
            ],
            [
                'id'    => 27,
                'title' => 'banner_card_access',
            ],
            [
                'id'    => 28,
                'title' => 'propert_type_create',
            ],
            [
                'id'    => 29,
                'title' => 'propert_type_edit',
            ],
            [
                'id'    => 30,
                'title' => 'propert_type_show',
            ],
            [
                'id'    => 31,
                'title' => 'propert_type_delete',
            ],
            [
                'id'    => 32,
                'title' => 'propert_type_access',
            ],
            [
                'id'    => 33,
                'title' => 'amenity_create',
            ],
            [
                'id'    => 34,
                'title' => 'amenity_edit',
            ],
            [
                'id'    => 35,
                'title' => 'amenity_show',
            ],
            [
                'id'    => 36,
                'title' => 'amenity_delete',
            ],
            [
                'id'    => 37,
                'title' => 'amenity_access',
            ],
            [
                'id'    => 38,
                'title' => 'service_create',
            ],
            [
                'id'    => 39,
                'title' => 'service_edit',
            ],
            [
                'id'    => 40,
                'title' => 'service_show',
            ],
            [
                'id'    => 41,
                'title' => 'service_delete',
            ],
            [
                'id'    => 42,
                'title' => 'service_access',
            ],
            [
                'id'    => 43,
                'title' => 'property_create',
            ],
            [
                'id'    => 44,
                'title' => 'property_edit',
            ],
            [
                'id'    => 45,
                'title' => 'property_show',
            ],
            [
                'id'    => 46,
                'title' => 'property_delete',
            ],
            [
                'id'    => 47,
                'title' => 'property_access',
            ],
            [
                'id'    => 48,
                'title' => 'enquiry_create',
            ],
            [
                'id'    => 49,
                'title' => 'enquiry_edit',
            ],
            [
                'id'    => 50,
                'title' => 'enquiry_show',
            ],
            [
                'id'    => 51,
                'title' => 'enquiry_delete',
            ],
            [
                'id'    => 52,
                'title' => 'enquiry_access',
            ],
            [
                'id'    => 53,
                'title' => 'testimonial_create',
            ],
            [
                'id'    => 54,
                'title' => 'testimonial_edit',
            ],
            [
                'id'    => 55,
                'title' => 'testimonial_show',
            ],
            [
                'id'    => 56,
                'title' => 'testimonial_delete',
            ],
            [
                'id'    => 57,
                'title' => 'testimonial_access',
            ],
            [
                'id'    => 58,
                'title' => 'logout_access',
            ],
            [
                'id'    => 59,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
