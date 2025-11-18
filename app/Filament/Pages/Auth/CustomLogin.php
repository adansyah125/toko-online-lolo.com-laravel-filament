<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login;

class CustomLogin extends Login
{
    public function getHeading(): string
    {
        return 'Selamat Datang';
    }


    public function getSubheading(): ?string
    {
        return 'Masukkan username dan password Anda';
    }
}
