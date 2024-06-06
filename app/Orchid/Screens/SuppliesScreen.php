<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Supply;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\SuppliesLayout;

class SuppliesScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'supplies' => Supply::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Товары';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Создать товар')
                ->icon('bs.plus')
                ->route('platform.supply'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            SuppliesLayout::class
        ];
    }
}
