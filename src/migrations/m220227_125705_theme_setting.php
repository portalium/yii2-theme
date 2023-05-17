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
            'name' => 'theme::menu_main',
            'label' => 'Active Web Menu',
            'value' => '1',
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
            'name' => 'theme::menu_side',
            'label' => 'Active Side Menu',
            'value' => '2',
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
            'name' => 'theme::menu_mobile',
            'label' => 'Active Mobile Menu',
            'value' => '1',
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

        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'menu',
            'name' => 'theme::menu_side_desktop',
            'label' => 'Side Menu Default Status(Desktop)',
            'value' => '',
            'type' => Form::TYPE_RADIOLIST,
            'config' => json_encode(['' => 'Show', 'active' => 'Hide'])
        ]);

        $this->insert(SiteModule::$tablePrefix . 'setting', [
            'module' => 'menu',
            'name' => 'theme::menu_side_mobile',
            'label' => 'Side Menu Default Status(Mobile)',
            'value' => '',
            'type' => Form::TYPE_RADIOLIST,
            'config' => json_encode(['active' => 'Show', '' => 'Hide'])
        ]);
    }

    public function down()
    {
        $this->delete(SiteModule::$tablePrefix . 'setting', ['module' => 'menu']);
    }
}
