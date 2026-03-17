<?php

namespace portalium\theme\widgets;

use Yii;
use yii\base\Widget;
use portalium\theme\bundles\ToastifyAsset;

class Toast extends Widget
{
    /**
     * Default toast duration (ms)
     * Can be overridden per flash type or by widget property
     */
    public $duration = 4000;

    /**
     * Optional color overrides
     * Example: ['success' => 'linear-gradient(to right, #4caf50, #81c784)']
     */
    public $colors = [];

    public function init()
    {
        parent::init();
        // Assets register
        ToastifyAsset::register($this->view);
    }

    public function run()
    {
        // Session flash’larını al
        $flashes = Yii::$app->session->getAllFlashes();
        if (empty($flashes)) {
            return;
        }

        $toastData = [];
        foreach ($flashes as $type => $messages) {
            foreach ((array)$messages as $message) {
                $toastData[] = [
                    'text' => $message,
                    'type' => $type,
                    'duration' => $this->duration,
                ];
            }
        }

        // Flash’ları temizle
        Yii::$app->session->removeAllFlashes();

        // JSON encode
        $jsonData = json_encode(
            $toastData,
            JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
        );

        // JS loop ile toast oluştur
        $js = <<<JS
(function(){
    var toasts = $jsonData;
    toasts.forEach(function(t){
        var colorMap = {
            success: 'linear-gradient(to right, #00b09b, #96c93d)',
            error: 'linear-gradient(to right, #ff5f6d, #ffc371)',
            warning: 'linear-gradient(to right, #f7971e, #ffd200)',
            info: 'linear-gradient(to right, #2193b0, #6dd5ed)',
            default: '#333'
        };
        // Merge with custom colors from PHP
        if (typeof window.toastColorOverrides === 'object') {
            Object.assign(colorMap, window.toastColorOverrides);
        }
        var background = colorMap[t.type] || colorMap.default;

        Toastify({
            text: t.text,
            duration: t.duration,
            gravity: 'top',
            position: 'right',
            close: true,
            style: {background: background},
        }).showToast();
    });
})();
JS;

        $this->view->registerJs($js);
    }
}