<?php

if (!function_exists('admin_name')) {
    function admin_name() {
        $db = db_connect();
        $builder = $db->table('users');
        $session = \Config\Services::session();
        $id = $session->userData['id'];
        $builder->select('name');
        $builder->where('id', $id);
        $data = $builder->get()->getRow()->name;
        return $data;

    }
}

if (!function_exists("randomString")) {
    function randomString(int $length = 0, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        if ($length < 1) {
            return false;
            die;
        }
        $keyspace = str_shuffle($keyspace);
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}

if (!function_exists("is_duplicate")) {
    function is_duplicate($table = '', $select = '', $where = array())
    {
        if (!empty($table)) {
            $db = db_connect();
            $builder = $db->table($table);
            $builder->select($select);
            if (!empty($where)) {
                $builder->where($where);
            }
            $count = $builder->countAllResults();
            if ($count == 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}

if (!function_exists('isValidEmail')) {
    function isValidEmail($email){ 
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (!function_exists('clean')) {
    function clean($string = '')
    {
        $string = str_replace(' ', '', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
}

if (!function_exists('pr')) {
    function pr($dataArr, $die = true)
    {
        echo "<pre>";
        print_r($dataArr);
        if ($die) {
            die;
        }
    }
}

if (!function_exists('get_count')) {
    function get_count($table, $where = ''){
        $db = db_connect();
        $builder = $db->table($table);
        $builder->select('id');
        if (!empty($where)) {
            $builder->where($where);
        }
        $count = $builder->countAllResults();
        if ($count > 0) {
            return $count;
        } else {
            return 0;
        }
    }
}

if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

if (!function_exists('uploadFile')) {
    function uploadFile($path='', $fieldName='', $oldFile='', $fileName = '')
    {
        $name = '';
        if (!empty($_FILES[$fieldName]['tmp_name'])) {
            $path = $path;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if (empty($fileName)) {
                $fileName = md5(uniqid(mt_rand()));
            }else {
                $fileName = $fileName;
            }

            $tmp_name = $_FILES[$fieldName]['tmp_name'];
            $name = $_FILES[$fieldName]['name'];
            $nameArr = explode('.',$name);
            $ext = end($nameArr);
            $name = $fileName.'.'.$ext;
            if (move_uploaded_file($tmp_name, $path.'/'.$name)) {
                if (!empty($oldFile)) {
                    $path = $path.'/';
                    if (file_exists($path.$oldFile)) {
                        unlink($path.$oldFile);
                    }
                }
                return $name;
            };
        }
    }
}

if (!function_exists('uploadFileMultiple')) {
    function uploadFileMultiple($path='', $fieldName='', $oldFile='', $fileName = '')
    {
        $name = '';
        $fileNameArr = array();
        if (!empty($_FILES[$fieldName]['tmp_name'][0])) {
            $path = $path;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $limit = count($_FILES[$fieldName]['tmp_name']);
            for ($i = 0; $i < $limit; $i++) {
                $tmp_name = $_FILES[$fieldName]['tmp_name'][$i];
                $name = $_FILES[$fieldName]['name'][$i];
                $nameArr = explode('.',$name);

                if (empty($fileName)) {
                    $fileNames = md5(uniqid(mt_rand()));
                }else {
                    $fileNames = $nameArr[0].$fileName;
                }
                
                $ext = end($nameArr);
                $name = $fileNames.'.'.$ext;
                if (move_uploaded_file($tmp_name, $path.'/'.$name)) {
                    if (!empty($oldFile)) {
                        $path = $path.'/';
                        if (file_exists($path.$oldFile)) {
                            unlink($path.$oldFile);
                        }
                    }
                    $fileNameArr[] =  $name;
                };
            }
            return $fileNameArr;
        }
    }
}

if (!function_exists('limitString')) {
    function limitString($text, $limit) 
    {
        $text = strip_tags($text);
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
}

if (!function_exists('error')) {
    function error($data) 
    {
        echo json_encode($data); die;
    }
}

if (!function_exists('encrypt')) {
    function encrypt($string) 
    {
        $output = false;
        $key = hash('sha256', getenv('secret_key'));
        $iv = substr(hash('sha256', getenv('secret_iv')), 0, 16);
        $output = openssl_encrypt($string, getenv('encrypt_method'), $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }
}

if (!function_exists('decrypt')) {
    function decrypt($string) 
    {
        $output = false;
        $key = hash('sha256', getenv('secret_key'));
        $iv = substr(hash('sha256', getenv('secret_iv')), 0, 16);
        $output = openssl_decrypt(base64_decode($string), getenv('encrypt_method'), $key, 0, $iv);
        return $output;
    }
}

if (!function_exists('leadingZero')) {
    function leadingZero($number, $requiredZeroes) 
    {
        return sprintf('%0'.$requiredZeroes.'d', $number);
    }
}

if (!function_exists('validateDate')) {
    function validateDate($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}

if (!function_exists('fieldValue')) {
    function fieldValue($table, $column = '', $where = ''){
        $db = db_connect();
        $session = \Config\Services::session();
        $builder = $db->table($table);
        $builder->select('*');
        if (!empty($where)) {
            $builder->where($where);
        }
        $val = $builder->get()->getRow()->$column;
        return $val;
    }
}

if (!function_exists('maxValue')) {
    function maxValue($table, $column = '', $where = ''){
        $db = db_connect();
        $session = \Config\Services::session();
        $builder = $db->table($table);
        $builder->selectMax($column);
        if (!empty($where)) {
            $builder->where($where);
        }
        $val = $builder->get()->getRow()->$column;
        return $val;
    }
}

if (!function_exists('slugify')) {
    function slugify($string, $spaceRepl = "-")
    {
        $string = str_replace("'", '-', $string);
        $string = str_replace("/", '-', $string);
        $string = str_replace(".", '-', $string);        
        $string = str_replace("²", '2', $string);
        return url_title(convert_accented_characters($string), true);
    }
}

if (!function_exists('numbertoWords')) {
    function numbertoWords($num)
    {
        $numberInput = $num; 
        $locale = 'en_US';
        $fmt = numfmt_create($locale, NumberFormatter::SPELLOUT);
        $in_words = numfmt_format($fmt, $numberInput);
        return $in_words;
    }
}

if (!function_exists('getGradeNPercentage')) {
    function getGradeNPercentage($totalNumbers = 0, $obtainedMarks = 0, $type = '')
    {
        if ((!empty($totalNumbers) && is_numeric($totalNumbers)) && (!empty($obtainedMarks) && is_numeric($obtainedMarks))) {
            $percentage = number_format(($obtainedMarks / $totalNumbers) * 100 , 2) ;
            $percentage = sprintf('%g',$percentage);
            if (strtoupper($type) == 'P') {
                return $percentage; die;
            }else{
                switch ($percentage) {
                    case ($percentage >= 80):
                        return 'A+';
                        break;

                    case ($percentage >= 70):
                        return 'A';
                        break;

                    case ($percentage >= 60):
                        return 'B+';
                        break;

                    case ($percentage >= 50):
                        return 'B';
                        break;

                    case ($percentage >= 40):
                        return 'C';
                        break;
                    default:
                        return 'FAILED';
                        break;
                }
            }
        }else {
            return false;
        }
    }
}

if (!function_exists('barcode')) {
    function barcode($string = '', $width = 0, $fileType = '')
    {
        if (empty($fileType)) {
            $fileType = 'PNG';
        }
        $widthVal = '';
        if ($width > 0) {
            $widthVal = "width=$width"."px";
        }
        return "<img class='slow-images' $widthVal src ='/public/barcode/html/image.php?filetype=".$fileType."&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=10&text=".$string."&thickness=50&start=NULL&code=BCGcode128' />";
    }
}

if (!function_exists('image_dimention_validation')) {
    function image_dimention_validation($image='',$required_width='',$required_height='')
    {
        $fileinfo = @getimagesize($image);
        $width = $fileinfo[0];
        $height = $fileinfo[1];
        if( $width != $required_width || $height != $required_height){
            return false;
        }
        return true;
    }
}

if (!function_exists('checkPwdStrength')) {
    function checkPwdStrength($password)
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return false;
        }else{
            return true;
        }
    }
}

if (!function_exists('sizeConverter')) {
    function sizeConverter($value = 0, $returnFormat = 'GB'){
        $data = 0;
        switch (strtoupper($returnFormat)) {
            case 'GB':
            $data = $value * (1/1024);
            break;
            
            case 'MB':
            $data = $value * 1024;
            break;
        }
        return $data;
    }
}