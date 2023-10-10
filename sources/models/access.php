<?php

    class access extends model {

        public function validationAccessLevel($allowed) {

            // $accessLevel = isset($_SESSION['accessLevel']) ? $_SESSION['accessLevel'] : false;

            // $response = (new database())->findOne('access_level', ['_id' => $accessLevel]);
            // if(!$response) {
            //     header('Location: ' . HTTP . '/auth/_logout');
            //     exit;
            // }

            // foreach($allowed as $key => $value){
            //     if($value == $response['name']) {
            //         return $response['name'];
            //     }
            // }

            // header('Location: ' . HTTP . '/auth/_logout');
            // exit;

        }

    }

?>