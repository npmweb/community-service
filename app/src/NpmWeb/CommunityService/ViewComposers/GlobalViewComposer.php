<?php namespace NpmWeb\CommunityService\ViewComposers;

use Illuminate\View\View;

/**
 * Adds data to every view in the app. Useful for data used in the layout.
 *
 * @author Josh Justice
 */
class GlobalViewComposer
    extends \NpmWeb\ServiceOpportunities\ViewComposers\GlobalViewComposer
{

    /**
     * Adds data to the view.
     *
     * @param \Illuminate\View\View $view
     */
    public function compose( View $view)
    {
        parent::compose($view);

        $config = \NpmWeb\ServiceOpportunities\Models\Config::singleton();
        $view_data = [
            'system_name' => $config->system_name,
        ];

        $view->with($view_data);
    }

}
