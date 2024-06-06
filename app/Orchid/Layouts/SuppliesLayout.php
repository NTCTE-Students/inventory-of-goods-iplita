<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use App\Models\Supply;

class SuppliesLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    public $target = 'supplies';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
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
            TD::make('amont', 'Количество'),
            TD::make('created_at', 'Дата создания')
                ->render(function (Supply $supply) {
                    return $supply->created_at->toDateString();
                }),
            TD::make('updated_at', 'Дата обновления')
                ->render(function (Supply $supply) {
                    return $supply->updated_at->toDateString();
                }),
        ];
    }
}
