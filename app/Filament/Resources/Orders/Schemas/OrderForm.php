<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order')->columns(2)->schema([
                    TextInput::make('order_number')->disabled()->dehydrated(false),
                    Select::make('status')->required()->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),
                    Select::make('payment_method')->options(['cod' => 'Cash on delivery', 'card' => 'Card'])->required(),
                    Select::make('delivery_method')->options(['delivery' => 'Delivery', 'pickup' => 'Pickup'])->required(),
                ]),
                Section::make('Customer')->columns(2)->schema([
                    TextInput::make('customer_name')->required(),
                    TextInput::make('customer_phone')->tel()->required(),
                    TextInput::make('customer_email')->email(),
                    KeyValue::make('shipping_address')->columnSpanFull(),
                ]),
                Section::make('Totals')->columns(3)->schema([
                    TextInput::make('subtotal')->numeric()->prefix('OMR')->disabled()->dehydrated(false),
                    TextInput::make('shipping')->numeric()->prefix('OMR'),
                    TextInput::make('total')->numeric()->prefix('OMR')->disabled()->dehydrated(false),
                    Textarea::make('notes')->columnSpanFull(),
                ]),
            ]);
    }
}
