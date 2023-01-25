<?php

namespace portalium\theme;

class Module extends \portalium\base\Module
{
    public static function moduleInit()
    {
        self::registerTranslation('theme','@portalium/theme/messages',[
            'theme/theme' => 'theme.php',
        ]);
    }

    public function registerComponents()
    {
        return [
            'theme' => [
                'class' => 'portalium\theme\Theme',
            ],
        ];
    }

    public static function t($message, array $params = [])
    {
        return parent::coreT('theme', $message, $params);
    }
}
