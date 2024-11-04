<?php namespace App\Libraries;

require_once APPPATH.'/Libraries/tcpdfcap/tcpdf.php';

class Tpdf extends \TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}
