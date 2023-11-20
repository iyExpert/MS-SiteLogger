<?php
namespace App\DTO;

class LogDto extends BaseDto
{
    public string $title;
    public string $action;
    public string $ip;
    public ?int $user_id = null;
    public ?string $date = null;
    public string $user_name = 'N/A';
    public string $type = 'INFO';
    public array $log = [];
}
