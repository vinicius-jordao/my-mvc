<?php

    class auth {

        public static function isOnline() {
            // Check if you have a session
            if(empty($_SESSION["user"]))
                return false;

            // Fetch the user's hash
            $userHash = $_SESSION["user"];
            $sessionId = session_id();

            return !empty($userHash);
        }

    }

?>