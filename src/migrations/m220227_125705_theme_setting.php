<?php

use portalium\db\Migration;
use portalium\menu\models\Menu;
use portalium\site\Module as SiteModule;
use portalium\site\models\Form;

class m220227_125705_theme_setting extends Migration
{
    public function up()
    {
        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'menu',
            'name' => 'main::menu',
            'label' => 'Active Web Menu',
            'value' => 'web-menu',
            'type' => Form::TYPE_DROPDOWNLIST,
            'config' => json_encode([
                'model' => [
                    'class' => 'portalium\menu\models\Menu', 
                    'map' => [
                        'key' => 'id_menu' ,
                        'value' => 'name'
                    ],
                    'where' => [
                        'type' => Menu::TYPE['web']
                    ]
                ]
            ])
        ]);

        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'menu',
            'name' => 'site::menu',
            'label' => 'Active Site Menu',
            'value' => 'web-menu',
            'type' => Form::TYPE_DROPDOWNLIST,
            'config' => json_encode([
                'model' => [
                    'class' => 'portalium\menu\models\Menu', 
                    'map' => [
                        'key' => 'id_menu' ,
                        'value' => 'name'
                    ],
                    'where' => [
                        'type' => Menu::TYPE['web']
                    ]
                ]
            ])
        ]);

        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'menu',
            'name' => 'menu::mobile',
            'label' => 'Active Mobile Menu',
            'value' => 'mobile-menu',
            'type' => Form::TYPE_DROPDOWNLIST,
            'config' => json_encode([
                'model' => [
                    'class' => 'portalium\menu\models\Menu', 
                    'map' => [
                        'key' => 'id_menu' ,
                        'value' => 'name'
                    ],
                    'where' => [
                        'type' => Menu::TYPE['mobile']
                    ]
                ]
            ])
        ]);
        
    }

    public function down()
    {
        $this->delete(SiteModule::$tablePrefix . 'setting', ['module' => 'menu']);
    }
}
