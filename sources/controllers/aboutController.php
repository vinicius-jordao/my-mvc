<?php

    class aboutController extends controller {

        public function index() {

            // Getting model infos
            $model_info = new numbers();

            // Getting model infos
            $user = new users();

            // Getting data
            $data = array(
                'name' => $user->getUser(),
                'old' => $model_info->allNumbers()
            );

            $this->loadTemplate('about', $data);

        }

    }

?>