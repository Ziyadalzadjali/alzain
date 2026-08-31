<?php

namespace App\Filament\Resources\ServiceCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->columns(2)->schema([
                    TextInput::make('name.en')->label('Name (English)')->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, $set, $context) => $context === 'create' ? $set('slug', Str::slug($state)) : null),
                    TextInput::make('name.ar')->label('Name (Arabic)')->required(),
                    TextInput::make('slug')->required()->unique(ignoreRecord: true),
                    Textarea::make('description.en')->label('Description (English)')->columnSpanFull(),
                    Textarea::make('description.ar')->label('Description (Arabic)')->columnSpanFull(),
                ]),
                Section::make()->columns(2)->schema([
                    Toggle::make('is_active')->default(true),
                    TextInput::make('sort')->numeric()->default(0),
                ]),
            ]);
    }
}
