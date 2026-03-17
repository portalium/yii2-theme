<?php

namespace portalium\theme\widgets;

use Yii;
use yii\base\Widget;
use portalium\theme\bundles\ToastifyAsset;

class Toast extends Widget
{
    /**
     * @var int Duration of the toast display in milliseconds.
     */
    public $duration = 4000;

    /**
     * @var array Additional color overrides for toast types.
     */
    public $colors = [];

    /**
     * @var array Color mappings for different alert types (e.g., success, error).
     */
    public $alertTypes = [];

    /**
     * @var string Position of the toast: 'left' or 'right'.
     */
    public $position = 'right';

    /**
     * @var string Gravity of the toast: 'top' or 'bottom'.
     */
    public $gravity = 'top';

    /**
     * @var bool Whether to show the close button on the toast.
     */
    public $close = true;

    /**
     * @var array Offset for the toast position as ['x' => int, 'y' => int].
     */
    public $offset = ['x' => 0, 'y' => 0];

    /**
     * @var bool Whether to stop the toast timer when focused.
     */
    public $stopOnFocus = true;

    public function init()
    {
        parent::init();
        ToastifyAsset::register($this->view);
    }

    public function run()
    {
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

        Yii::$app->session->removeAllFlashes();

        $jsonData = json_encode(
            $toastData,
            JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
        );

        $jsonColors = json_encode($this->colors);

        $jsonAlertTypes = json_encode($this->alertTypes);

        $jsonPosition = json_encode($this->position);

        $jsonGravity = json_encode($this->gravity);

        $jsonClose = json_encode($this->close);

        $jsonOffset = json_encode($this->offset);

        $jsonStopOnFocus = json_encode($this->stopOnFocus);

        $js = <<<JS
(function(){
    var toasts = $jsonData;
    var colorMap = {
        success: 'linear-gradient(to right, #00b09b, #96c93d)',
        error: 'linear-gradient(to right, #ff5f6d, #ffc371)',
        warning: 'linear-gradient(to right, #f7971e, #ffd200)',
        info: 'linear-gradient(to right, #2193b0, #6dd5ed)',
        default: '#333'
    };
    // Merge with alertTypes override
    if ($jsonAlertTypes) {
        Object.assign(colorMap, $jsonAlertTypes);
    }
    // Merge with frontend override
    if (typeof window.toastColorOverrides === 'object') {
        Object.assign(colorMap, window.toastColorOverrides);
    }
    // Merge with PHP override
    if ($jsonColors) {
        Object.assign(colorMap, $jsonColors);
    }

    toasts.forEach(function(t){
        var background = colorMap[t.type] || colorMap.default;
        Toastify({
            text: t.text,
            duration: t.duration,
            gravity: $jsonGravity,
            position: $jsonPosition,
            close: $jsonClose,
            offset: $jsonOffset,
            stopOnFocus: $jsonStopOnFocus,
            style: {background: background},
        }).showToast();
    });
})();
JS;

        $this->view->registerJs($js);
    }
}