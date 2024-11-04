<?php namespace App\Libraries;



require_once APPPATH.'/Libraries/PHPMailer/Exception.php';



class exception extends \Exception

{

    function __construct()

    {

        parent::__construct();

    }

}