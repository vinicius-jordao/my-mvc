<?php

    class validations extends model {

        public static function validationEmptyInputs($inputs, $keys) {

            foreach($keys as $key => $name) {
                if(!isset($inputs[$key]) || empty($inputs[$key])) {
                    return 'O campo ' . $name . ' deve ser preenchido!';
                }
            }

            return false;

        }

        public static function removeAllSpecifyKeys($array, $keysToRemove) {

            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = self::removeAllSpecifyKeys($value, $keysToRemove);
                } else {
                    if (in_array($key, $keysToRemove)) {
                        unset($array[$key]);
                    }
                }
            }

            return $array;
        }

        public static function hasDuplicateValues($multiArray) {
            function findDuplicateValues($array) {
                $flattenArray = array();
                $duplicates = array();

                // Flatten the multidimensional array into a single-dimensional array
                $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
                foreach ($iterator as $key => $value) {
                    if (in_array($value, $flattenArray)) {
                        if (!isset($duplicates[$value])) {
                            $duplicates[$value] = array();
                        }
                        $duplicates[$value][] = $key;
                    }
                    $flattenArray[] = $value;
                }

                return $duplicates;
            }

            $duplicateValues = findDuplicateValues($multiArray);

            if (!empty($duplicateValues)) {
                foreach ($duplicateValues as $value => $keys) {
                    return 'Há mais de um campo chamado "' . $value . '", os campos devem ter nomes diferentes!';
                }
            }
            return false;

        }

    }

?>