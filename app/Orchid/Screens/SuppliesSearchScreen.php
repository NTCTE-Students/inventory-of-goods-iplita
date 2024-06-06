<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Supply;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class SuppliesSearchScreen extends Screen
{
    public $query = '';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request): array
    {
        $this->query = $request->get('query', '');
        $query = $request->get('query', '');
        $supplies = Supply::where('name', 'LIKE', "%{$query}%")
                           ->orWhere('description', 'LIKE', "%{$query}%")
                           ->get();

        return [
            'supplies' => $supplies,
            'query' => $query
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Поиск товаров';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Искать')
                ->method('search')
                ->icon('bs.search'),
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
                Input::make('query')
                    ->title('Поиск')
                    ->type('text')
                    ->placeholder('Введите запрос для поиска...')
                    ->value($this->query),
            ]),
            Layout::table('supplies', [
                TD::make('id', 'ID')
                ->render(function (Supply $supply) {
                    return Link::make($supply->id)
                        ->route('platform.supply', $supply);
                }),
            TD::make('name', 'Название')
                ->render(function (Supply $supply) {
                    return Link::make($supply->name)
                        ->route('platform.supply', $supply);
                }),
                TD::make('description', 'Описание'),
                TD::make('price', 'Цена (в копейках)'),
                TD::make('amount', 'Количество'),
                TD::make('created_at', 'Дата создания'),
                TD::make('updated_at', 'Дата обновления')
            ]),
        ];
    }

    public function search(Request $request)
    {
        return redirect()->route('platform.supplies.search', ['query' => $request->input('query')]);
    }
}
