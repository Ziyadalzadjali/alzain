<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference')->searchable()->weight('bold'),
                TextColumn::make('customer_name')->searchable()
                    ->description(fn ($record) => $record->customer_phone),
                TextColumn::make('service.name')->getStateUsing(fn ($record) => $record->service?->name)->label('Service'),
                TextColumn::make('branch.name')->getStateUsing(fn ($record) => $record->branch?->name)->label('Branch'),
                TextColumn::make('date')->date()->sortable(),
                TextColumn::make('time')->time('H:i')->sortable(),
                TextColumn::make('status')->badge()->color(fn ($state) => match ($state) {
                    'confirmed' => 'success',
                    'completed' => 'info',
                    'cancelled' => 'danger',
                    default => 'warning',
                }),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ]),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
