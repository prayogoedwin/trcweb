<?php

namespace App\Filament\Widgets;

use App\Models\TradeConfig;
use Filament\Widgets\Widget;

class TradeToggleWidget extends Widget
{
    protected string $view = 'filament.widgets.trade-toggle-widget';

    public ?TradeConfig $trade = null;

    public function mount(): void
    {
        $this->trade = TradeConfig::first(); // sesuaikan logic
    }

    public function toggle(): void
    {
        $this->trade->update([
            'is_active' => ! $this->trade->is_active,
        ]);

        $this->trade->refresh();
    }
}
