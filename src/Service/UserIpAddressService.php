<?php

namespace App\Service;

class UserIpAddressService
{
    private string $ipAddress;

    public function __construct()
    {
        $this->ipAddress = $_ENV['IP_ADDRESS'];
    }

    public function getUserIpAddress(): string
    {
        return $this->ipAddress;
    }


}