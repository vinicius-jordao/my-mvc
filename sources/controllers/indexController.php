<?php

    class indexController extends controller {

        public function index() {

            $this->definePageTitle('Início - Easy Tickets');
            $this->loadTemplate('website/home', 'website', []);

        }

    }

?>