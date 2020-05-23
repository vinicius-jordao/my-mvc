<?php

    class homeController extends controller {

        public function index() {

            // Getting data
            $data = array(
                'x' => 20,
                'y' => 'etc',
                'z' => 'anything'
            );

            $this->loadTemplate('home', $data);

        }

    }

?>