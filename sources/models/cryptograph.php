<?php

    class cryptograph extends model {

        public function encryptPassword($password, $string) {
            $salt = $this->md5HashGenerator($string);
            $cust = '08';
            $encrypt = crypt($password, '$2a$' . $cust . '$' . $salt . '$');
            return $encrypt;
        }

        public function md5HashGenerator($string) {
            $date = date("Y/m/d");
            $hash = md5($string . $date . rand(0, 8888));
            return $hash;
        }

    }

?>