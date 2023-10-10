<?php

    class cronController extends controller {

        public function index() {

            $this->definePageTitle('Início');
            $this->loadTemplate('index', 'default', []);

        }

        public function createBillings() {

            $database = new database();

            $date = date('Y-m-d');
            $billingDay = date('d', strtotime($date . ' +7 days'));

            $billings = $database->findAll('signers', ['deleted' => 0, 'billing_schedule' => 1, 'billing_day' => $billingDay], [], 'ORDER BY _id DESC');
            if(!$billings) {
                echo 'Nenhum agendamento para hoje';
                return false;
            }

            foreach ($billings as $key => $billing) {
                $billingData = [
                    'sign' => $billing['hash'],
                    'user' => $billing['user'],
                    'admin' => $billing['admin'],
                    'value' => $billing['price'],
                    'billing_type' => 2,
                    'billing_date' => date('Y-m-d', strtotime($date . ' +7 days'))
                ];
                $verify = $database->simpleVerify('billings', $billingData);
                if(!$verify) {
                    $billingData['hash'] = (new cryptograph())->md5HashGenerator($billing['accession_price']);
                    $insert = $database->simpleInsert('billings', $billingData);
                    if($insert) {
                        echo '<span style="color: #2E7D32">Cobrança da assinatura ' . $billing['hash'] . ' foi gerada!</span><br>';
                    }
                } else {
                    echo '<span style="color: #e91e63">Fatura da assinatura ' . $billing['hash'] . ' já existe!</span><br>';
                }
            }

        }

    }

?>