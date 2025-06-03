<?php

namespace App\Exceptions;

use Exception;

class FiscalYearOverlapException extends Exception
{
    protected $message = 'The fiscal year overlaps with an existing period';
}
