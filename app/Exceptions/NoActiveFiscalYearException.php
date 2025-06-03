<?php

namespace App\Exceptions;

use Exception;

class NoActiveFiscalYearException extends Exception
{
    protected $message = 'No active fiscal year found';
}
