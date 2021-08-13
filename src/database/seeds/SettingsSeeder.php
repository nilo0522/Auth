<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting -> setting ="Session";
        $setting -> value = "Hour";
        $setting -> attr = json_encode([
            "option" =>
                [
                    ["value" => "Seconds","text" => "Seconds"],
                    ["value" => "Minute","text" => "Minute"],
                    ["value" => "Hour","text" => "Hour"],
                    ["value" => "Day","text" => "Day"],
                    ["value" => "Week","text" => "Week"],
                    ["value" => "Month","text" => "Month"],
                    ["value" => "Year","text" => "Year"],

                ]
        ]);
        $setting -> time = "2";
        $setting -> component = "checkbox";


        \Fligno\Auth\Models\AppSetting::create(

        );

    }
}
