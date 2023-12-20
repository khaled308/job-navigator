<?php

namespace Framework;

class Validation {
    private static function rules() {
        return [
            'required' => function($prop){
                if (!isset($prop) || strlen($prop) == 0)
                    return "is required";

                return true;
            },
            'min_length' => function(string $str, int $min = 1) {
                if (strlen($str) < $min)
                    return "min Length is $min";

                return true;
            },
            'max_length' => function($str, $max) {
                if (strlen($str) > $max)
                    return "max Length is $max";

                return true;
            }
        ];
    }

    public static function validate($data, $validationRules) {
        // $validationRules = ['title => 'required, min_length=5,max_length=12']
        $errors = [];
        foreach($validationRules as $prop => $rules) {
            $rules = explode(',', $rules);

            foreach($rules as $rule) {
                $rule = trim($rule);
                $error = self::checkRule($rule, $data[$prop]);

                if ($error)
                    $errors[] = "$prop $error";
            }
        }
        
        return $errors;
    }

    private static function checkRule($rule, $data) {
        $rulesMap = Validation::rules();
        $error = null;

        if (strpos($rule, '=')) {
            [$key, $value] = explode('=', $rule);
            $fn = $rulesMap[$key];

            if ($fn){
                $res = $fn($data, $value);
                if (is_string($res))
                    $error = $res;
            }
        }
        else {
            $fn = $rulesMap[$rule];

            if ($fn) {
                $res= $fn($data);
                if (is_string($res))
                    $error = $res;
            }
        }
        return $error;
    }
}