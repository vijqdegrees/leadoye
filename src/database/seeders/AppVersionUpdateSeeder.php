<?php

namespace Database\Seeders;

use App\Models\Core\Auth\Permission;
use App\Models\Core\Auth\Role;
use App\Models\Core\Auth\RolePermissionPivot;
use App\Models\Core\Auth\Type;
use App\Models\Core\Auth\User;
use App\Models\Core\Setting\Setting;
use App\Models\Core\Status;
use Database\Seeders\App\NotificationEventTableSeeder;
use Database\Seeders\App\NotificationTemplateSeeder;
use Database\Seeders\Auth\PermissionRoleTableSeeder;
use Database\Seeders\Auth\PermissionTableSeeder;
use Database\Seeders\Status\StatusSeeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class AppVersionUpdateSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->disableForeignKeys();

        $this->permissionSeederUpdate();
        RolePermissionPivot::query()->truncate();
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(NotificationEventTableSeeder::class);
        $this->call(NotificationTemplateSeeder::class);
        $this->settingSeederUpdate();
        $this->statusSeederUpdate();

        Model::reguard();
    }

    public function permissionSeederUpdate()
    {
        $crmId = Type::findByAlias('crm')->id;
        Permission::query()->insert(
            [
                //Invoice
                [
                    'name' => 'view_invoice',
                    'type_id' => $crmId,
                    'group_name' => 'invoices'
                ],
                [
                    'name' => 'create_invoice',
                    'type_id' => $crmId,
                    'group_name' => 'invoices'
                ],
                [
                    'name' => 'update_invoice',
                    'type_id' => $crmId,
                    'group_name' => 'invoices'
                ],
                [
                    'name' => 'delete_invoice',
                    'type_id' => $crmId,
                    'group_name' => 'invoices'
                ],
                [
                    'name' => 'download_invoice',
                    'type_id' => $crmId,
                    'group_name' => 'invoices'
                ],
                [
                    'name' => 'invoice_get_deal_contact_person',
                    'type_id' => $crmId,
                    'group_name' => 'invoices'
                ],
                [
                    'name' => 'invoice_sending_attachment_mail',
                    'type_id' => $crmId,
                    'group_name' => 'invoices'
                ],
                //Deals
                [
                    'name' => 'owner_deals',
                    'type_id' => $crmId,
                    'group_name' => 'deals'
                ],
                [
                    'name' => 'details_deal',
                    'type_id' => $crmId,
                    'group_name' => 'deals'
                ],
            ]
        );
    }

    public function statusSeederUpdate()
    {
        Status::query()->insert(
            [
                [
                    'name' => 'status_unpaid',
                    'type' => 'invoice',
                    'class' => 'danger',
                ],
                [
                    'name' => 'status_paid',
                    'type' => 'invoice',
                    'class' => 'success',
                ],
            ]
        );
    }

    public function settingSeederUpdate()
    {
        Setting::query()->insert(
            [
                ['name' => 'invoice_logo', 'value' => '/images/invoice-logo.png', 'context' => 'app', 'autoload' => 0, 'public' => 1],
                ['name' => 'invoice_starting_number', 'value' => '1', 'context' => 'app', 'autoload' => 0, 'public' => 1],
                ['name' => 'invoice_prefix', 'value' => 'INV', 'context' => 'app', 'autoload' => 0, 'public' => 1],
            ]
        );
    }
}
