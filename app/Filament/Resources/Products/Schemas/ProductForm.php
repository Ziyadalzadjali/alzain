<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\ProductCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product')->columns(2)->schema([
                    Select::make('product_category_id')->label('Category')->required()
                        ->options(fn () => ProductCategory::all()->pluck('name', 'id')),
                    TextInput::make('slug')->required()->unique(ignoreRecord: true),
                    TextInput::make('name.en')->label('Name (English)')->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, $set, $context) => $context === 'create' ? $set('slug', Str::slug($state)) : null),
                    TextInput::make('name.ar')->label('Name (Arabic)')->required(),
                    TextInput::make('brand'),
                    TextInput::make('sku')->label('SKU'),
                    Textarea::make('short_description.en')->label('Short description (English)')->rows(2)->columnSpanFull(),
                    Textarea::make('short_description.ar')->label('Short description (Arabic)')->rows(2)->columnSpanFull(),
                    Textarea::make('description.en')->label('Description (English)')->rows(5)->columnSpanFull(),
                    Textarea::make('description.ar')->label('Description (Arabic)')->rows(5)->columnSpanFull(),
                ]),
                Section::make('Pricing & stock')->columns(3)->schema([
                    TextInput::make('price')->required()->numeric()->prefix('OMR')->step('0.001')->default(0),
                    TextInput::make('sale_price')->numeric()->prefix('OMR')->step('0.001')
                        ->helperText('Leave empty for no discount'),
                    TextInput::make('stock')->required()->numeric()->default(0),
                ]),
                Section::make('Images')->schema([
                    FileUpload::make('images')->image()->multiple()->reorderable()->directory('products'),
                ]),
                Section::make()->columns(3)->schema([
                    Toggle::make('is_featured'),
                    Toggle::make('is_active')->default(true),
                    TextInput::make('sort')->numeric()->default(0),
                ]),
            ]);
    }
}
