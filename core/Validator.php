<?php


use http\Cookie;

class Validator extends Book
{
    protected $errors =  array();
    public $flash = array();
    public $months  = [1 => "Janvier", "Février",  "Mars",  "Avril", "Mai", "Juin",  "Juillet", "Août",  "Septembre", "Octobre", "Novembre", "Décembre"];

    /**
     * @param string $email
     * @return int
     */
    public function preg_email(string $email){

        $pattern = "/(^[a-z0-9]+)@([a-z])+(\.)([a-z]{2,3})/";
        if(preg_match($pattern, $email) == 1){

            $msg = 1;
        }else{

            $msg = 0;
        }
        return $msg;
    }

    /**
     * @param string $string
     * @return int
     */
    function preg_string(string $string){

        $pattern = "/^-?[a-zA-Zéèêëíìîïñóòôöõúùûüýÿæ -\ ]+$/";
        if(preg_match($pattern, $string) == 1){

            $msg = 1;
        }else{
            $msg = 0;
        }

        return $msg;
    }

    /**
     * @param string $num
     * @return int
     */
    function preg_number(string $num){

        $pattern = "/^(\+)[0-9]{11,12}/";
        if(preg_match($pattern, $num) == 1){

            $msg = 1;
        }else{

            $msg = 0;
        }

        return $msg;
    }
    function preg_int(string $num){
        $pattern = "/^[0-9]+$/";
        if (preg_match($pattern, $num)){
            $msg = 1;
        }else{
            $msg = 0;
        }
        return $msg;
    }

    /**
     * @param string $name
     * @return string
     */
    public function post(string $name){

        if(isset($_POST[$name])) return $this->cleaningString($_POST[$name]);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function files(string $name){

        if(isset($_FILES[$name])) return $_FILES[$name];
    }


    /**
     * @param string $name
     * @return string
     */
    public function phone(string $name){

        $value = $this->post($name);

        if(!empty($value)){

            if($this->preg_number($value) == 1){

                return $value;
            }else{

                $this->errors[$name] = "Your number is incorrect.<br/> Ex +380633471236";
            }
        }else{

            $this->errors[$name] = "Field $name is required";
        }
    }

    /**
     * @param string $name
     * @return string
     */
    public function text(string $name){

        $value = $this->post($name);

        $detach = explode('_', $name);
        $string = implode(' ', $detach);

        if(!empty($value)){

            if($this->preg_string($value) == 1){

                return $value;
            }else{

                $this->errors[$name] = "Your $string contains characters  not allowed";
            }
        }else{

            $this->errors[$name] = "Field $string is required";
        }
    }

    /**
     * @param string $name
     * @return string
     */
    public function select_day(string $name){
        $value = $this->post($name);

        if($this->preg_int($value) === 1){
            return $value;
        }else{
            $this->errors[$name] = "Field $name is required";
        }
    }

    /**
     * @param string $name
     * @return string
     */
    public function select_month(string $name){

        $value = $this->post($name);

        if(array_key_exists($value, $this->months) == true){

            if($this->preg_int($value) === 1){
                return $value;
            }else{
                $this->errors[$name] = "Field $name is required";
            }
        }else{
            $this->errors[$name] = "The value of the field must not be changed";
        }
    }

    /**
     * @param string $name
     * @return string
     */
    public function select_year(string $name){
        $value = $this->post($name);

        $pattern  = "/^(19|20)[0-9]{2}/";

        if($value !== ''){

            if(preg_match($pattern, $value) === 1){

                if($value < 2012){

                    return $value;
                }else{

                    $this->errors[$name] = "Field $name is incorrect";
                }
            }else{

                $this->errors[$name] = "Field $name is incorrect";
            }
        }else{
            $this->errors[$name] = "Field $name is required";
        }

    }

    /**
     * @param string $name
     * @return string
     */
    public function emplacement(string $name){
        $value = $this->post($name);

        $pattern = "/^[a-zA-Z ,]+$/";

        if($value !== ''){

            if(preg_match($pattern, $value) === 1){

                $location = explode(',', $value);
                $city = ucfirst($location[0]);
                $country = strtoupper(end($location));

                //return [$city, $country];
                return  $value;

            }else{
                $this->errors[$name] = "Field $name is incorrect";
            }
        }else{
            $this->errors[$name] = "Field $name is required";
        }
    }

    /**
     * @param $name
     * @return string
     */
    public function radio($name){
        $value = $this->post($name);
        $option = ['male' => 'Male', 'female' => 'Female'];

        if($value !== null){

            if(array_key_exists($value, $option) == true){

                return $value;
            }else{
                $this->errors[$name] = "The value of the field must not be changed";
            }
        }else{
            $this->errors[$name] = "Field $name is required";
        }
    }


    /**
     * @param $name
     * @return string
     */
    public function email_or_phone($name){
        $value = $this->post($name);
        $pattern = "/^[0-9 +]+$/";

        $detach = explode('_', $name);
        $string = implode(' ', $detach);

        if($value !== ''){

            if(preg_match($pattern, $value)){
                return $this->phone($name);
            }else{
                return $this->email($name);
            }
        }else{
            $this->errors[$name] = "Field $string is required";
        }
    }

    /**
     * @param $name
     * @return string
     */
    public function password($name){
        $value = $this->post($name);
        if($value !== ''){
            if(strlen($value) >= 5){

                return sha1($value);
            }else{
                $this->errors[$name] = "Password must be at least 5 characters long";
            }
        }else{
            $this->errors[$name] = "Field $name is required";
        }
    }

    /**
     * @param $name
     */
    public function remember($name){
        $value = $this->post($name);
        if($value == 1){
            setcookie('remember', 'true', time() + 3600);
        }
    }

    /**
     * @param string $name
     * @return string
     */
    public function file(string $name){

        $files = $this->files($name);

        $extensions = ['png', 'jpeg', 'jpg', 'gif'];

        $file_name = $files["name"];
        $file_error = $files['error'];

        if($file_error === 0  && strlen($file_name) > 0){

            $detach = explode('.', $file_name);
            $extension = strtolower(end($detach));

            if(in_array($extension, $extensions)){

                $file_size = $files['size'];
                if($file_size <= 3200000){

                    $new_name = strtolower($this->alphaNumCode(3).'.'.$extension);
                    $tmp_name = $files['tmp_name'];

                    //create the storage location of the files
                    $stone = "storage";
                    if(!is_dir($stone)){
                        mkdir($stone);
                    }
                    $storage = $stone."/".$new_name;

                    if(move_uploaded_file($tmp_name, $storage) == TRUE){

                        return $new_name;

                        //return "The file has been downloaded successfully";
                    }else{

                        $this->errors[$name] = "There was a problem uploading";
                    }
                }else{

                    $this->errors[$name] = "The file exceeds 32 Mo";
                }

            }else{
                $this->errors[$name] = "The file is not allowed";
            }

        }else{
            $this->errors[$name] = "Select your file";
        }

    }


    /**
     * @param string $name
     * @return string
     */
    public function email(string $name){

        $value = $this->post($name);

        if(!empty($value)){

            if($this->preg_email($value) == 1){

                return $value;
            }else{

                $this->errors[$name] = "Your email is incorrect";
            }
        }else{
            $this->errors[$name] = "Field $name is required";
        }

    }


    /**
     * @param string $name
     * @return mixed
     */
    public function error(string $name){

        if(isset($this->errors[$name])) return $this->errors[$name];
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function message_flash(string $name){

        if(isset($this->flash[$name])) return $this->flash[$name];
    }

    /**
     * @return string
     */
    public function success(){
        if(empty($this->errors)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return string
     */
    public function flash(){
        if(empty($this->flash)){
            return true;
        }else{
            return false;
        }

    }


    /**
     * @param $name
     * @param $args
     */
    public function __call($name, $args){

        echo $name," doesn't exist in this class";
    }
}