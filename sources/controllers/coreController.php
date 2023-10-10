<?php

    class defaultController extends controller {

        public function index() {

            $this->definePageTitle('Início');
            $this->loadTemplate('index', 'default', []);

        }

        // default functions

        public function returnTemplate() {
            $data = $_POST;

            $template = isset($data['template']) && !empty($data['template']) ? $data['template'] : false;
            if(!$template) {
                $response['error'] = 'Modal indefinido.';
                echo json_encode($response);
                return false;
            }

            // get template
            $template = file_get_contents(HTTP . '/assets/templates/' . $template . '.php');
            if(!$template) {
                $response['error'] = 'Ocorreu um erro.';
                echo json_encode($response);
                return false;
            }

            $response['html'] = $template;
            echo json_encode($response);
        }

        public function returnDinamic() {
            $data = $_POST;

            $template = isset($data['template']) && !empty($data['template']) ? $data['template'] : false;
            if(!$template) {
                $response['error'] = 'Template indefinido.';
                echo json_encode($response);
                return false;
            }

            // get template
            $template = file_get_contents(HTTP . '/static/' . $template);
            if(!$template) {
                $response['error'] = 'Ocorreu um erro.';
                echo json_encode($response);
                return false;
            }

            $response['html'] = $template;
            foreach ($data as $key => $item) {
                $response['html'] = str_replace('_' . $key . '_', $item, $response['html']);
            }

            echo json_encode($response);
        }

        public function returnStatic() {
            $data = $_POST;

            $template = isset($data['template']) && !empty($data['template']) ? $data['template'] : false;
            if(!$template) {
                $response['error'] = 'Modal indefinido.';
                echo json_encode($response);
                return false;
            }

            // get template
            $template = file_get_contents(HTTP . '/static/' . $template);
            if(!$template) {
                $response['error'] = 'Ocorreu um erro.';
                echo json_encode($response);
                return false;
            }

            $response['html'] = $template;
            echo json_encode($response);
        }

        public function _sendMail() {
            $response = [];

            // post
            $data = $_POST;
            $response['data'] = $data;

            // define template
            $template = $data['template'];
            unset($data['template']);

            // define template
            $subjectMail = $data['subjectMail'];
            unset($data['subjectMail']);

            // get template
            $template = file_get_contents(HTTP . '/assets/templates/' . $template . '.html');

            // replace
            foreach ($data as $key => $value) {
                $template = str_replace('_' . $key . '_', $value, $template);
            }

            $database = new database();

            // send mail
            $send = $database->sendMail('contato@credimedigital.com.br', $subjectMail, $template);
            if(!$send) {
                $response['error'] = 'Ocorreu um erro ao tentar enviar!';
                echo json_encode($response);
                return false;
            }

            // return
            $response['status'] = true;
            echo json_encode($response);
        }

        public function simpleUploadImage() {
            $database = new database();
            // image post
            $image = $_FILES['image'];
            // define image
            if(isset($image['name']) && !empty($image['name'])) {
                // define vars
                $data_image = array(
                    'hash' => (new cryptograph())->md5HashGenerator($image['name']),
                    'name' => $image['name'],
                    'type' => $image['type'],
                    'size' => $image['size'],
                    'content' => file_get_contents($image['tmp_name'])
                );
                // insert
                $insert = $database->simpleInsert('files', $data_image);
                if(!$insert) {
                    $response['error'] = 'Erro ao salvar imagem! Tente novamente.';
                    echo json_encode($response);
                    return false;
                }
                // return
                $response['success'] = 'Imagem enviada com sucesso: ' . $data_image['hash'];
                echo json_encode($response);
                return false;
            }
            // load view
            $this->loadView('default/simple-upload-image', []);
        }

        public function success() {

            $data = [];
            $data['title'] = isset($_GET['title']) ? $_GET['title'] : '';
            $data['description'] = isset($_GET['description']) ? $_GET['description'] : '';
            $data['button'] = isset($_GET['button']) ? $_GET['button'] : '';
            $data['link'] = isset($_GET['link']) ? $_GET['link'] : '';

            $this->definePageTitle('CREDIME | Sucesso! ' . $data['title']);
            $this->loadTemplate('default/success', 'status', $data);

        }

        public function error() {

            $data = [];
            $data['title'] = isset($_GET['title']) ? $_GET['title'] : '';
            $data['description'] = isset($_GET['description']) ? $_GET['description'] : '';
            $data['button'] = isset($_GET['button']) ? $_GET['button'] : '';
            $data['link'] = isset($_GET['link']) ? $_GET['link'] : '';

            $this->definePageTitle('Erro! ' . $data['title']);
            $this->loadTemplate('default/error', 'status', $data);

        }

        public function logout() {
            session_destroy();
            header('Location: ' . HTTP . '/login');
            exit;
        }

    }

?>