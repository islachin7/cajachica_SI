<?php namespace App\Libraries;



require_once APPPATH.'/Libraries/PHPMailer/POP3.php';



class pop extends  \POP3

{

    function __construct()

    {

        parent::__construct();

    }

}

