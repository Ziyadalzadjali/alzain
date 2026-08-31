<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Models\ServiceCategory;
use App\Models\Staff;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Details')->columns(2)->schema([
                    Select::make('service_category_id')->label('Category')->required()
                        ->options(fn () => ServiceCategory::all()->pluck('name', 'id')),
                    TextInput::make('slug')->required()->unique(ignoreRecord: true),
                    TextInput::make('name.en')->label('Name (English)')->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, $set, $context) => $context === 'create' ? $set('slug', Str::slug($state)) : null),
                    TextInput::make('name.ar')->label('Name (Arabic)')->required(),
                    Textarea::make('description.en')->label('Description (English)')->rows(4)->columnSpanFull(),
                    Textarea::make('description.ar')->label('Description (Arabic)')->rows(4)->columnSpanFull(),
                ]),
                Section::make('Pricing & booking')->columns(3)->schema([
                    TextInput::make('price')->required()->numeric()->prefix('OMR')->step('0.001')->default(0),
                    TextInput::make('duration_minutes')->label('Duration (min)')->required()->numeric()->default(60),
                    Select::make('staff')->label('Specialists')->multiple()->relationship('staff', 'id')
                        ->options(fn () => Staff::all()->pluck('name', 'id')),
                    FileUpload::make('image')->image()->directory('services')->columnSpanFull(),
                ]),
                Section::make()->columns(3)->schema([
                    Toggle::make('is_featured'),
                    Toggle::make('is_active')->default(true),
                    TextInput::make('sort')->numeric()->default(0),
                ]),
            ]);
    }
}
