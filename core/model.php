<?php

    class model {

        protected $database;

        public function __construct() {

            global $database;

            $this->database = $database;

        }

    }

?>