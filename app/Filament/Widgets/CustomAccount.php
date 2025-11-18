<?php

namespace App\Filament\Widgets;

use Filament\Widgets\AccountWidget;

class CustomAccount extends AccountWidget
{
    public function getColumnSpan(): int|string|array
    {
        return 'full'; // membuat widget full width
    }

    
}
