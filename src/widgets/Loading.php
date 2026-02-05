<?php

namespace portalium\theme\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Loading widget for displaying loading indicators using Modal
 * 
 * Usage in layout/view:
 * ```php
 * use portalium\theme\widgets\Loading;
 * 
 * // Register the widget (usually in layout)
 * Loading::widget();
 * ```
 * 
 * JavaScript usage:
 * ```javascript
 * // Show loading with default message
 * window.showLoading();
 * 
 * // Show loading with custom message
 * window.showLoading('Please wait...');
 * 
 * // Hide loading
 * window.hideLoading();
 * ```
 */
class Loading extends Widget
{
    /**
     * @var string Default loading message
     */
    public $defaultMessage = 'YÃ¼kleniyor...';

    /**
     * @var string Modal ID
     */
    public $modalId = 'portalium-loading-modal';

    /**
     * @var bool Whether to auto-register the widget
     */
    public static $registered = false;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if (self::$registered) {
            return '';
        }

        self::$registered = true;

        $this->registerAssets();
        return $this->renderLoading();
    }

    /**
     * Render the loading HTML using Modal widget
     */
    protected function renderLoading()
    {
        ob_start();

        Modal::begin([
            'id' => $this->modalId,
            'size' => 'modal-lg',
            'clientOptions' => [
                'backdrop' => 'static',
                'keyboard' => false,
                'show' => false
            ],
            'closeButton' => false,
            'titleOptions' => ['style' => 'display: none;'],
            'options' => ['style' => 'z-index: 99999;'],
            'bodyOptions' => ['style' => 'display: flex; flex-direction:column; align-items:center; gap:15px;'],
            'centerVertical' => true,
        ]);

        echo Html::tag('div', '', ['class' => 'loader-logo']);
        echo Html::tag('hr', '', ['class' => 'loading-divider', 'style' => 'width: 100%; margin: 0;']);
        echo Html::tag('div', $this->defaultMessage, [
            'class' => 'loading-message',
            'id' => $this->modalId . '-message'
        ]);

        Modal::end();

        return ob_get_clean();
    }

    /**
     * Register CSS and JavaScript assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        $modalId = $this->modalId;

        // Register CSS
        $css = <<<CSS
.loader-logo {
    width: fit-content;
    font-size: 35px;
    letter-spacing: 5px;
    font-family: system-ui, sans-serif;
    font-weight: bold;
    text-transform: uppercase;
    color: #0000;
    -webkit-text-stroke: 1px #7ed957;
    background:
        radial-gradient(0.71em at 50% 1em, #7ed957 99%, #0000 101%) calc(50% - 1em) 1em/2em 200% repeat-x text,
        radial-gradient(0.71em at 50% -0.5em, #0000 99%, #7ed957 101%) 50% 1.5em/2em 200% repeat-x text;
    -webkit-background-clip: text;
    background-clip: text;
    animation: 
        l10-0 .8s linear infinite alternate,
        l10-1 4s linear infinite;
    margin: 0 auto;
}

.loader-logo:before {
    content: "Loading";
}

.loading-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
}

.loading-message {
    margin-right: 0px;
    float: right;
    width: 100% !important;
    height: auto !important;
    color: black;
    margin-bottom: 5px;
    white-space: normal;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor: pointer;
    max-height: 60px;
    text-align: left;
    display: flex;
    align-items: center;
    justify-content: space-between;
    align-items: baseline;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

@keyframes l10-0 {
    to {
        background-position-x: 50%, calc(50% + 1em);
    }
}

@keyframes l10-1 {
    to {
        background-position-y: -.5em, 0;
    }
}
CSS;

        $view->registerCss($css);

        // Register JS
        $defaultMessage = Json::htmlEncode($this->defaultMessage);

        $js = <<<JS
(function() {
    'use strict';
    
    let loadingModalInstance = null;
    
    /**
     * Show loading modal
     * @param {string} message - Optional custom message
     */
    window.showLoading = function(message) {
        const modal = document.getElementById('{$modalId}');
        const messageEl = document.getElementById('{$modalId}-message');
        
        if (modal) {
            if (message && messageEl) {
                messageEl.textContent = message;
            } else if (messageEl) {
                messageEl.textContent = {$defaultMessage};
            }
            
            // Bootstrap 5 Modal API
            if (!loadingModalInstance) {
                loadingModalInstance = new bootstrap.Modal(modal, {
                    backdrop: 'static',
                    keyboard: false
                });
            }
            loadingModalInstance.show();
        }
    };
    
    /**
     * Hide loading modal
     */
    window.hideLoading = function() {
        const modal = document.getElementById('{$modalId}');
        const messageEl = document.getElementById('{$modalId}-message');
        
        if (modal && loadingModalInstance) {
            loadingModalInstance.hide();
            
            // Reset to default message after hiding
            if (messageEl) {
                setTimeout(function() {
                    messageEl.textContent = {$defaultMessage};
                }, 300);
            }
        }
    };
    
    /**
     * Show loading with auto-hide after specified duration
     * @param {string} message - Optional custom message
     * @param {number} duration - Duration in milliseconds (default: 2000)
     */
    window.showLoadingFor = function(message, duration) {
        duration = duration || 2000;
        window.showLoading(message);
        setTimeout(function() {
            window.hideLoading();
        }, duration);
    };
    
    // Listen for other modals opening - hide loading modal
    document.addEventListener('show.bs.modal', function(event) {
        // If another modal is opening and it's not the loading modal
        if (event.target.id !== '{$modalId}' && loadingModalInstance) {
            const loadingModal = document.getElementById('{$modalId}');
            if (loadingModal && loadingModal.classList.contains('show')) {
                loadingModalInstance.hide();
            }
        }
    });
})();
JS;

        $view->registerJs($js, $view::POS_END);
    }
}