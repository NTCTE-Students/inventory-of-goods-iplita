<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Supply;
use App\Models\SupplyIssue;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;

class SupplyIssueScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products' => Supply::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Выдача товаров';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Выдать товар')
                ->method('issue')
                ->icon('bs.plus'),
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
            Layout::rows([
                Select::make('supply_id')
                    ->fromModel(Supply::class, 'name')
                    ->title('Товар')
                    ->required(),
                Input::make('quantity')
                    ->type('number')
                    ->title('Количество')
                    ->required(),
            ]),
            Layout::table('issues', [
                TD::make('supply.name', 'Товар'),
                TD::make('quantity', 'Количество'),
                TD::make('issue_quantity', 'Количество выданного'),
                TD::make('created_at', 'Дата выдачи')
                    ->render(function (SupplyIssue $supply) {
                        return $supply->created_at->toDateString();
                }),
            ]),
        ];
    }

    public function issue()
    {
        return redirect()->route('platform.issue');
    }
}
