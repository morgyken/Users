<?php

namespace Ignite\Users\Widgets;

use Ignite\Core\Library\BaseDashboardWidgets;
use Ignite\Users\Entities\User;

class ActiveWidget extends BaseDashboardWidgets {

    /**
     * Get the widget name
     * @return string
     */
    protected function name() {
        return 'ActiveUsers';
    }

    /**
     * Get the widget view
     * @return string
     */
    protected function view() {
        return 'users::widgets.active';
    }

    /**
     * Get the widget data to send to the view
     * @return string
     */
    protected function data() {
        return ['active' => User::all()->count()];
    }

    /**
     * Get the widget type
     * @return string
     */
    protected function options() {
        return [
            'width' => '2',
            'height' => '2',
            'x' => '10',
            'y' => '0',
        ];
    }

}
