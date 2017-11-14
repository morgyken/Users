<?php

namespace Ignite\Users\Widgets;

use Ignite\Core\Library\BaseDashboardWidgets;
use Ignite\Users\Entities\User;

class UserCountWidget extends BaseDashboardWidgets
{

    /**
     * Get the widget name
     * @return string
     */
    protected function name()
    {
        return 'Users';
    }

    /**
     * Get the widget view
     * @return string
     */
    protected function view()
    {
        return 'users::widgets.count';
    }

    /**
     * Get the widget data to send to the view
     * @return array
     */
    protected function data()
    {
        return ['userCount' => User::count()];
    }

    /**
     * Get the widget type
     * @return string
     */
    protected function options()
    {
        return [
            'width' => '2',
            'height' => '2',
            'x' => '8',
            'y' => '0',
        ];
    }

}
