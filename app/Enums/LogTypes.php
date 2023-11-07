<?php

namespace App\Enums;

enum LogTypes: string
{
    case INFO = 'INFO';
    case ERROR = 'ERROR';
    case DEBUG = 'DEBUG';
}
