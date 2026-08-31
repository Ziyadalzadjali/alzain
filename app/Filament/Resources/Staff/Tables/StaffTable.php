<?php

namespace App\Filament\Resources\Staff\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StaffTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->circular(),
                TextColumn::make('name')->getStateUsing(fn ($record) => $record->name),
                TextColumn::make('title')->getStateUsing(fn ($record) => $record->title),
                TextColumn::make('branch.name')->getStateUsing(fn ($record) => $record->branch?->name)->label('Branch'),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('sort')->sortable(),
            ])
            ->defaultSort('sort')
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
