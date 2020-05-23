<?php

    class homeController extends controller {

        public function index() {

            // Getting model infos
            $model_info = new numbers();

            // Getting data
            $data = array(
                'x' => $model_info->allNumbers()
            );

            $this->loadTemplate('home', $data);

        }

    }

?>