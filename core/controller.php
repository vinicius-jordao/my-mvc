<?php

    class controller {

        // Load view
        public function loadView($viewName, $viewData = array()) {

            // Get array key and change for variable
            extract($viewData);

            require 'sources/views/pages/pages-site'.$viewName.'.php';

        }

        // Load and show template
        public function loadTemplate($viewName, $viewData = array()) {

            // Show template
            require 'sources/views/templates/template-site.php';

        }

        // Load view into the template
        public function loadViewInTemplate($viewName, $viewData = array()) {

            // Get array key and change for variable
            extract($viewData);

            require 'sources/views/pages/pages-site/'.$viewName.'.php';

        }

    }

?>