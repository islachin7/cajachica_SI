<?php namespace App\Libraries;



require_once APPPATH.'/Libraries/PHPMailer/SMTP.php';



class smtp extends \SMTP

{

    function __construct()

    {

        parent::__construct();

    }

}