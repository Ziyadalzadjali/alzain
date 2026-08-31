<?php

namespace App\Filament\Resources\Branches\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BranchesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->getStateUsing(fn ($record) => $record->name)->searchable(query: fn ($query, $search) => $query->where('name', 'like', "%{$search}%")),
                TextColumn::make('city')->getStateUsing(fn ($record) => $record->city),
                TextColumn::make('phone'),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('sort')->sortable(),
            ])
            ->defaultSort('sort')
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
