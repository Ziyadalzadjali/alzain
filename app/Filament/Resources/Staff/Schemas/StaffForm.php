<?php

namespace App\Filament\Resources\Staff\Schemas;

use App\Models\Branch;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->columns(2)->schema([
                    Select::make('branch_id')->label('Branch')
                        ->options(fn () => Branch::all()->pluck('name', 'id')),
                    FileUpload::make('photo')->image()->directory('staff'),
                    TextInput::make('name.en')->label('Name (English)')->required(),
                    TextInput::make('name.ar')->label('Name (Arabic)')->required(),
                    TextInput::make('title.en')->label('Title (English)'),
                    TextInput::make('title.ar')->label('Title (Arabic)'),
                    Textarea::make('bio.en')->label('Bio (English)')->columnSpanFull(),
                    Textarea::make('bio.ar')->label('Bio (Arabic)')->columnSpanFull(),
                ]),
                Section::make()->columns(2)->schema([
                    Toggle::make('is_active')->default(true),
                    TextInput::make('sort')->numeric()->default(0),
                ]),
            ]);
    }
}
