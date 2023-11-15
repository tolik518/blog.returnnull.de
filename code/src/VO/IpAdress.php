<?php

namespace Returnnull;

class IpAdress
{
    private string $ip;
    private function __construct($ip)
    {
        $this->ip = $this->validate($ip);
    }

    private function validate($ip): string
    {
        if (str_contains($ip,"."))
        {
            $ip = $this->validateIPv4($ip);
        }
        elseif (str_contains($ip,":"))
        {
            $ip = $this->validateIPv6($ip);
        }
        else
        {
            $ip = 'unknown';
        }

        return $ip;
    }

    private function validateIPv4($ip): string //legacy IP
    {
        $ip_exploded = explode(".", $ip);

        // censor the real IP
        $pseudobyte = (int)(((int)$ip_exploded[3] + (int)$ip_exploded[2])/2);

        $ip_exploded[2] = $pseudobyte;
        $ip_exploded[3] = 0;

        $ip = implode(".", $ip_exploded);

        return $ip;
    }

    private function validateIPv6($ip): string //real IP
    {
        $ip_exploded = explode(":", $ip);

        //censor the real IP
        $pseudobyte = (int)(((int)hexdec($ip_exploded[6]) + (int)hexdec($ip_exploded[7]))/2);

        $ip_exploded[6] = str_pad( dechex($pseudobyte), 4, "0", STR_PAD_LEFT );
        $ip_exploded[7] = "0000";

        $ip = implode(":", $ip_exploded);
        return $ip;
    }

    public function __toString(): string
    {
        return $this->ip;
    }

    public static function fromString(string $ip): IpAdress
    {
        return new IpAdress($ip);
    }
}