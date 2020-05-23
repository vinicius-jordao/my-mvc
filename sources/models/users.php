<?php

    class users extends model {

        public function getUser() {

            $sql = "SELECT * FROM users where id = 1";

            $sql = $this->database->query($sql);

            if($sql == true) {

                $sql = $sql->fetch();
                
                return $sql['name'];

            } else {

                return 0;

            }

        }

    }

?>