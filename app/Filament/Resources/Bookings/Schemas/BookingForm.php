<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Branch;
use App\Models\Service;
use App\Models\Staff;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Appointment')->columns(2)->schema([
                    Select::make('service_id')->label('Service')->required()
                        ->options(fn () => Service::all()->pluck('name', 'id')),
                    Select::make('branch_id')->label('Branch')->required()
                        ->options(fn () => Branch::all()->pluck('name', 'id')),
                    Select::make('staff_id')->label('Specialist')
                        ->options(fn () => Staff::all()->pluck('name', 'id')),
                    Select::make('status')->required()->default('pending')
                        ->options([
                            'pending' => 'Pending',
                            'confirmed' => 'Confirmed',
                            'completed' => 'Completed',
                            'cancelled' => 'Cancelled',
                        ]),
                    DatePicker::make('date')->required(),
                    TimePicker::make('time')->required()->seconds(false),
                ]),
                Section::make('Customer')->columns(2)->schema([
                    TextInput::make('customer_name')->required(),
                    TextInput::make('customer_phone')->tel()->required(),
                    TextInput::make('customer_email')->email(),
                    TextInput::make('reference')->disabled()->dehydrated(false),
                    Textarea::make('notes')->columnSpanFull(),
                ]),
            ]);
    }
}
