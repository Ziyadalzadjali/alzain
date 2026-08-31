<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')->searchable()->weight('bold'),
                TextColumn::make('customer_name')->searchable()
                    ->description(fn ($record) => $record->customer_phone),
                TextColumn::make('items_count')->counts('items')->label('Items'),
                TextColumn::make('total')->formatStateUsing(fn ($state) => omr($state))->sortable(),
                TextColumn::make('payment_method')->badge(),
                TextColumn::make('status')->badge()->color(fn ($state) => match ($state) {
                    'paid' => 'success',
                    'shipped', 'delivered' => 'info',
                    'cancelled' => 'danger',
                    default => 'warning',
                }),
                TextColumn::make('created_at')->dateTime('d M Y H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'paid' => 'Paid',
                    'shipped' => 'Shipped',
                    'delivered' => 'Delivered',
                    'cancelled' => 'Cancelled',
                ]),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
