<?php

namespace Roski;

use \BaseController;
use \Menu;
use \Auth;
use \Session;
use \Department;
use \Response;
use \User;
use \App;

class StaffController extends BaseController
{
	
	const REMEMBER = 20;

    /**
     * Setup menu and other layout
     */
    public function setupLayout()
    {
        if ($this->layout) {
            Menu::setOption('item.active_child_class', 'active');

            $menu = Menu::handler('main', array('class' => 'nav navbar-nav'));

			$menu->add(route('form.index'), 'Start');
			$menu->add(route('form.review'), 'Previous Submissions');

            $menu->getItemsAtDepth(0)->map(
                function ($item) {
                    if ($item->hasChildren()) {
                        $item->addClass('dropdown');

                        $item->getChildren()
                            ->addClass('dropdown-menu');

                        $item->getContent()
                            ->addClass('dropdown-toggle')
                            ->dataToggle('dropdown')
                            ->nest(' <b class="caret"></b>');
                    }
                }
            );
        }


        parent::setupLayout();
    }

}
