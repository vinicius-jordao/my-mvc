<?php

    class controller {

        // Load view
        public function loadView($viewName, $viewData = array()) {

            // Get array key and change for variable
            extract($viewData);

            require 'sources/views/pages/'.$viewName.'.php';

        }

        // Load and show template
        public function loadTemplate($template, $viewName, $viewData = array()) {

            // Show template
            require 'sources/views/templates/'.$template.'php';

        }

        // Load view into the template
        public function loadViewInTemplate($viewName, $viewData = array()) {

            // Get array key and change for variable
            extract($viewData);

            require 'sources/views/pages/'.$viewName.'.php';

        }

    }

?>