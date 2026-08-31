<?php

namespace App\Filament\Resources\Branches\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BranchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Name & location')->columns(2)->schema([
                    TextInput::make('name.en')->label('Name (English)')->required(),
                    TextInput::make('name.ar')->label('Name (Arabic)')->required(),
                    TextInput::make('city.en')->label('City (English)'),
                    TextInput::make('city.ar')->label('City (Arabic)'),
                    Textarea::make('address.en')->label('Address (English)')->columnSpanFull(),
                    Textarea::make('address.ar')->label('Address (Arabic)')->columnSpanFull(),
                ]),
                Section::make('Contact')->columns(2)->schema([
                    TextInput::make('phone')->tel(),
                    TextInput::make('whatsapp')->tel(),
                    TextInput::make('map_url')->label('Google Maps URL')->url()->columnSpanFull(),
                ]),
                Section::make('Opening hours')->schema([
                    Repeater::make('hours')->hiddenLabel()->columns(2)->schema([
                        TextInput::make('en')->label('English')->placeholder('Sat–Thu: 9:00 – 21:00'),
                        TextInput::make('ar')->label('Arabic')->placeholder('السبت–الخميس: 9:00 – 21:00'),
                    ])->addActionLabel('Add a line'),
                ]),
                Section::make()->columns(2)->schema([
                    Toggle::make('is_active')->default(true),
                    TextInput::make('sort')->numeric()->default(0),
                ]),
            ]);
    }
}
