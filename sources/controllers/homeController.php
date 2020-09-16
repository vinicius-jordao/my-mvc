<?php

    class homeController extends controller {

        public function index() {

            $template = 'example';

            $this->loadTemplate($template, 'home', $data);

        }

    }

?>