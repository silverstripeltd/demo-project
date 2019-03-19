<?php

namespace {

    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\View\Requirements;

    class PageController extends ContentController
    {
        /**
         * An array of actions that can be accessed via a request. Each array element should be an action name, and the
         * permissions or conditions required to allow the user to access it.
         *
         * <code>
         * [
         *     'action', // anyone can access this action
         *     'action' => true, // same as above
         *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
         *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
         * ];
         * </code>
         *
         * @var array
         */
        private static $allowed_actions = [];

        protected function init()
        {
            parent::init();
            // You can include any CSS or JS required by your project here.
            // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
            Requirements::css("//fonts.googleapis.com/css?family=Raleway:300,500,900%7COpen+Sans:400,700,400italic");
            Requirements::themedCSS("bootstrap.min.css");
            Requirements::themedCSS("style.css");
//
            Requirements::themedJavascript("js/common/modernizr.js");
            Requirements::themedJavascript("js/common/jquery-1.11.1.min.js");
            Requirements::themedJavascript("js/common/bootstrap.min.js");
            Requirements::themedJavascript("js/common/bootstrap-datepicker.js");
            Requirements::themedJavascript("js/common/chosen.min.js");
            Requirements::themedJavascript("js/common/bootstrap-checkbox.js");
            Requirements::themedJavascript("js/common/nice-scroll.js");
            Requirements::themedJavascript("js/common/jquery-browser.js");
            Requirements::themedJavascript("js/scripts.js");
        }
    }
}
