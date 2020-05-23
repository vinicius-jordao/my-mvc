<?php

    // It is the center of the whole process
    class Core {

        // This function is activated when entering any url
        public function start() {

            // Setting default url
            $url = '/';

            // Checks if url has been sent
            if(isset($_GET['url'])) {

                // Concatenates with url that user typed
                $url .= $_GET['url'];

            }

            // Set as default
            $params = array();

            // Checking if something was sent at the url
            if(!empty($url) && $url != '/') {

                // Separating url information
                $url = explode('/', $url);

                // Deletes the first item in the array. To delete the last one use pop
                array_shift($url);

                // Getting url controller
                $current_controller = $url[0].'Controller';

                // Delete controller from list
                array_shift($url);

                // Checks if any actions have been sent
                if(isset($url[0]) && !empty($url[0])) {

                    $current_action = $url[0];

                    // Delete action from list
                    array_shift($url);

                } else {

                    // Delete action from list
                    array_shift($url);

                    // Set as default
                    $current_action = 'index';

                }

                // Checking if something was sent as params
                if(count($url) > 0 && $url != '/') {

                    $params = $url;

                }

            } else {

                $current_controller = 'homeController';

                $current_action = 'index';

            }

            // Starting selected controller
            $classe = new $current_controller();

            // Starting selected action.
            // This function is for when the system does not know what action it is and needs to pass parameters
            call_user_func_array(array($classe, $current_action), $params);

        }

    }

?>