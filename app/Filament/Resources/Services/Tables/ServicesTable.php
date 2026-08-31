<?php

namespace App\Filament\Resources\Services\Tables;

use App\Models\ServiceCategory;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->getStateUsing(fn ($record) => $record->name)
                    ->description(fn ($record) => $record->getTranslation('name', 'ar'))
                    ->searchable(query: fn ($q, $s) => $q->where('name', 'like', "%{$s}%")),
                TextColumn::make('category.slug')->label('Category')->badge(),
                TextColumn::make('price')->formatStateUsing(fn ($state) => omr($state))->sortable(),
                TextColumn::make('duration_minutes')->label('Min')->sortable(),
                IconColumn::make('is_featured')->boolean(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('sort')->sortable(),
            ])
            ->defaultSort('sort')
            ->filters([
                SelectFilter::make('service_category_id')->label('Category')
                    ->options(fn () => ServiceCategory::all()->pluck('name', 'id')),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
