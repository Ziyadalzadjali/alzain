<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\ProductCategory;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->getStateUsing(fn ($record) => $record->name)
                    ->description(fn ($record) => $record->getTranslation('name', 'ar'))
                    ->searchable(query: fn ($q, $s) => $q->where('name', 'like', "%{$s}%")),
                TextColumn::make('category.slug')->label('Category')->badge(),
                TextColumn::make('brand')->searchable(),
                TextColumn::make('price')->formatStateUsing(fn ($state) => omr($state))->sortable(),
                TextColumn::make('sale_price')->formatStateUsing(fn ($state) => $state ? omr($state) : '—')->sortable(),
                TextColumn::make('stock')->sortable()
                    ->color(fn ($state) => $state < 1 ? 'danger' : ($state < 5 ? 'warning' : 'success')),
                IconColumn::make('is_featured')->boolean(),
                IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('sort')
            ->filters([
                SelectFilter::make('product_category_id')->label('Category')
                    ->options(fn () => ProductCategory::all()->pluck('name', 'id')),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
