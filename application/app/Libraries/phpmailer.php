<?php namespace App\Libraries;



require_once APPPATH.'/Libraries/PHPMailer/PHPMailer.php';



class phpmailer extends  \PHPMailer

{

    function __construct()

    {

        parent::__construct();

    }

}

