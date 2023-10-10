<?php

    class rules {

        private $public;

        // define class and method public
        private function addPublic($class, $method) {
            $class = $class . 'Controller';
            $this->public[] = array("class" => $class, "method" => $method);
        }

        public function __construct() {
            // public list
            // view login
            $this->addPublic('auth', 'login');
            $this->addPublic('auth', '_processLogin');
            $this->addPublic('auth', 'register');
            $this->addPublic('auth', '_logout');
            // registers the user only by the code
            $this->addPublic('auth', '_registerUser');
            $this->addPublic('auth', '');
            // static content
            $this->addPublic('static', '');
            // cron
            $this->addPublic('cron', '');

            // dev
            $this->addPublic('index', '');
            $this->addPublic('category', '');
            $this->addPublic('event', '');
            $this->addPublic('admin', '');
            $this->addPublic('producer', '');
            $this->addPublic('affiliated', '');
            $this->addPublic('user', '');
        }

        public function checkNoAuth($class, $method) {
            return in_array(array("class" => $class, "method" => $method), $this->public) || in_array(array("class" => $class, "method" => ""), $this->public);
        }

    }

?>