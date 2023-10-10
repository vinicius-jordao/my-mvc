<?php

    class database extends model {

        // busca dado com filtro simples
        public function simpleSumAll($table, $data, $sum) {
            $where = '';
            $count = 0;
            foreach ($data as $name => $input) {
                $where .= ($count > 0 ? ' AND ' : '') . $name . ' = :' . $name;
                $count++;
            }
            $sql = "SELECT sum(" . $sum . ") FROM " . $table . " WHERE " . $where;
            $sql = $this->database->prepare($sql);
            foreach ($data as $name => $input) {
                $sql->bindValue(':' . $name, $input);
            }
            $sql->execute();
            if($sql->rowCount() > 0) {
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        // conta quantos registros existe na tabela, com base no where
        public function countRegisters($table, $data) {
            $where = '';
            $count = 0;
            foreach ($data as $name => $input) {
                $where .= ($count > 0 ? ' AND ' : '') . $name . ' = :' . $name;
                $count++;
            }
            $sql = "SELECT count(*) FROM " . $table . (isset($data) && !empty($data) ? " WHERE " . $where : '');
            $sql = $this->database->prepare($sql);
            foreach ($data as $name => $input) {
                $sql->bindValue(':' . $name, $input);
            }
            if($sql->execute()) {
                return $sql->fetchColumn();
            } else {
                return false;
            }
        }

        // atualiza dados com filtro simples
        public function simpleUpdate($table, $set, $where) {
            $string_set = '';
            $count_set = 0;
            foreach ($set as $name => $input) {
                $string_set .= ($count_set > 0 ? ', ' : '') . $name . ' = :' . $name;
                $count_set++;
            }
            $string_where = '';
            $count_where = 0;
            foreach ($where as $name => $input) {
                $string_where .= ($count_where > 0 ? ' AND ' : '') . $name . ' = :' . $name;
                $count_where++;
            }
            $sql = "UPDATE " . $table . " SET " . $string_set . " WHERE " . $string_where;
            $sql = $this->database->prepare($sql);
            foreach ($set as $name => $input) {
                $sql->bindValue(':' . $name, $input);
            }
            foreach ($where as $name => $input) {
                $sql->bindValue(':' . $name, $input);
            }
            if($sql->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // busca dado com filtro simples
        public function findOneOnly($table, $data, $only) {
            $where = '';
            $count = 0;
            foreach ($data as $name => $input) {
                $where .= ($count > 0 ? ' AND ' : '') . $name . ' = :' . $name;
                $count++;
            }
            $sql = "SELECT " . implode(', ', $only) . " FROM " . $table . " WHERE " . $where;
            $sql = $this->database->prepare($sql);
            foreach ($data as $name => $input) {
                $sql->bindValue(':' . $name, $input);
            }
            $sql->execute();
            if($sql->rowCount() > 0) {
                return $sql->fetch();
            } else {
                return false;
            }
        }

        // busca dado com filtro simples
        public function findOne($table, $data) {
            $where = '';
            $count = 0;
            foreach ($data as $name => $input) {
                $where .= ($count > 0 ? ' AND ' : '') . $name . ' = :' . $name;
                $count++;
            }
            $sql = "SELECT * FROM " . $table . " WHERE " . $where;
            $sql = $this->database->prepare($sql);
            foreach ($data as $name => $input) {
                $sql->bindValue(':' . $name, $input);
            }
            $sql->execute();
            if($sql->rowCount() > 0) {
                return $sql->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        // busca dados com filtro simples
        public function findAll($table, $arrayWhere, $pagination, $order) {
            $pageLimit = isset($pagination['limit']) ? $pagination['limit'] : '';
            $pageInitial = isset($pagination['page']) ? $pageLimit * ($pagination['page'] - 1) : '';
            // define limit query
            $limit = ($pageLimit > 0 ? ' LIMIT ' . ($pageInitial ? $pageInitial : 0) . ', ' . $pageLimit : '');
            // define where query
            $where = '';
            $count = 0;
            foreach ($arrayWhere as $name => $input) {
                $where .= ($count > 0 ? ' AND ' : " WHERE ") . $name . ' = :' . $name . ' ';
                $count++;
            }
            // build query
            $sql = "SELECT * FROM " . $table . $where . ' ' . $order . $limit;
            $sql = $this->database->prepare($sql);
            // define values
            foreach ($arrayWhere as $name => $input) {
                $sql->bindValue(':' . $name, $input);
            }
            // execute
            $sql->execute();
            // return
            if($sql->rowCount() > 0) {
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        // verifica se o registro já existe
        public function simpleVerify($table, $arrayWhere) {
            $where = '';
            $count = 0;
            foreach ($arrayWhere as $name => $input) {
                $where .= ($count > 0 ? ' AND ' : '') . $name . ' = :' . $name;
                $count++;
            }
            $sql = "SELECT count(*) FROM " . $table . " WHERE " . $where;
            $sql = $this->database->prepare($sql);
            foreach ($arrayWhere as $name => $input) {
                $sql->bindValue(':' . $name, $input);
            }
            $sql->execute();
            if($sql->fetchColumn() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function simpleInsert($table, $data) {
            $data['log'] = date('Y-m-d h:i:s');
            // implode columns
            $names = [];
            foreach ($data as $name => $value) {
                $names[] = $name;
            }
            $columns = implode(',', $names);
            $values = ':' . implode(',:', $names);
            // create query
            $sql = "INSERT INTO " . $table . "(" . $columns . ") VALUES (" . $values . ")";
            $sql = $this->database->prepare($sql);
            // define values
            foreach ($data as $title => $value) {
                $sql->bindValue(':' . $title, $value);
            }
            // execute and return
            if($sql->execute()) {
                return true;
            }
            return false;
        }

        public function sendMail($destiny, $subject, $message) {
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= 'From: Credime Digital <no-reply@credimedigital.com.br>';
            $send = mail($destiny, $subject, $message, $headers);
            if($send) {
                return true;
            } else {
                return false;
            }
        }

    }

?>