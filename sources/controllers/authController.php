<?php

    class authController extends controller {

        public function index() {

            $this->definePageTitle('Login');
            $this->loadTemplate('login', 'default', []);

        }

        public function login() {

            $data = array();

            // load
            $this->definePageTitle('Login');
            $this->loadTemplate('website/login', 'default', $data);

        }

        public function _processLogin() {

            $data = $_POST;

            $database = new database();

            // verify
            foreach ($data as $key => $value) {
                if(empty($value)) {
                    $response['error'] = 'Preencha todos os campos!';
                    echo json_encode($response);
                    return false;
                }
            }

            $where = [
                'mail' => $data['mail'],
                'deleted' => 0
            ];

            $user = $database->findOneOnly('users', $where, ['_id_access_level', 'password', 'hash', '_id', 'name']);
            if(!$user) {
                $response['error'] = 'Usuário não cadastrado!';
                echo json_encode($response);
                return false;
            }

            $password = $user['password'];
            if(crypt($data['password'], $password) !== $password) {
                $response['error'] = 'Senha incorreta!';
                echo json_encode($response);
                return false;
            }

            $access = $database->findOneOnly('access_level', ['_id' => $user['_id_access_level']], ['name']);
            if(!$access) {
                $response['error'] = 'Opa, algo de certo não ta errado kk' . $user['_id_access_level'];
                echo json_encode($response);
                return false;
            }

            $_SESSION['accessLevel'] = $user['_id_access_level'];
            $_SESSION['user'] = $user['hash'];
            $_SESSION['userId'] = $user['_id'];
            $_SESSION['name'] = $user['name'];

            $response['link'] = HTTP . '/' . $access['name'];
            $response['success'] = true;
            echo json_encode($response);

        }

        public function _registerUser() {

            $database = new database();
            $cryptograph = new cryptograph();

            $data = array();
            $data['mail'] = 'producer@easytickets.com.br';
            $data['password'] = '12345678';
            $data['hash'] = $cryptograph->md5HashGenerator($data['mail']);
            $data['password'] = $cryptograph->encryptPassword($data['password'], $data['mail']);

            $insert = $database->simpleInsert('users', $data);
            if(!$insert) {
                $response['error'] = 'Error: User not registered';
                echo json_encode($response);
                return false;
            }

            $response['Success'] = 'User registered';
            echo json_encode($response);

        }

    }
