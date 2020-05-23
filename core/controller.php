<?php

    class controller {

        // Load view
        public function loadView($name, $data = array()) {

            // Get array key and change for variable
            extract($data);

            require 'sources/views/pages/pages-site'.$name.'.php';

        }

        // Load and show template
        public function loadTemplate($name, $data = array()) {

            // Show template
            require 'sources/views/templates/template-site/index.php';

        }

        // Load view into the template
        public function loadViewInTemplate($name, $data = array()) {

            // Get array key and change for variable
            extract($data);

            require 'sources/views/pages/pages-site/'.$name.'.php';

        }

    }

?>