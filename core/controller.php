<?php

    class controller {

        // define page active
        public function definePageActive($page) {
            define("PAGE_ACTIVE", $page);
        }

        // define page title
        public function definePageTitle($title) {
            define("PAGE_TITLE", $title);
        }

        // Load view
        public function loadView($viewName, $viewData = array()) {

            // Get array key and change for variable
            extract($viewData);

            require 'sources/views/pages/'.$viewName.'.php';

        }

        // Load and show template
        public function loadTemplate($viewName, $template, $viewData = array()) {

            // Show template
            require 'sources/views/templates/'.$template.'.php';

        }

        // Load view into the template
        public function loadViewInTemplate($viewName, $viewData = array()) {

            // Get array key and change for variable
            extract($viewData);

            require 'sources/views/pages/'.$viewName.'.php';

        }

    }

?>