<?php

namespace portalium\theme\widgets;

class ListView extends \portalium\widgets\ListView
{
    public $showFooter = true;
    public $customLayout = false;
    public function init()
    {
        parent::init();

        if ($this->customLayout) {
            return;
        }

        if ($this->showFooter) {
            $this->layout = "{items}<div class='panel-footer d-flex justify-content-between'>" . str_replace('{items}', '', $this->layout) . '</div>';
        } else {
            $this->layout = "{items}";
        }
        if (strpos($this->layout, '{pagesizer}{pager}') !== false) {
            $this->layout = str_replace('{pagesizer}{pager}', '<div class="d-flex">{pagesizer}{pager}</div>', $this->layout);
        } else {
            $this->layout = str_replace('{pager}', '<div class="d-flex">{pager}</div>', $this->layout);
        }
    }
}
