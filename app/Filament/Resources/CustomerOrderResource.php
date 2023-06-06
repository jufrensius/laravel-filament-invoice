<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerOrderResource\Pages;
use App\Filament\Resources\CustomerOrderResource\RelationManagers;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Status;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\{
    Card,
    Component,
    DatePicker,
    Grid,
    Placeholder,
    Repeater,
    Section,
    Select,
    Textarea,
    TextInput
};
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerOrderResource extends Resource
{
    protected static ?string $model = CustomerOrder::class;
    protected static ?string $modelLabel = 'Invoice';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $slug = 'invoices'; // change the resource URL

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)
                    ->schema([
                        Section::make('Billing to')
                            ->schema([
                                Card::make()
                                    ->schema([
                                        TextInput::make('invoice_number')
                                            ->default(static::getNextInvoiceNumber()),
                                        Select::make('customers')
                                            ->relationship('customers', 'name')
                                            ->label('Customer')
                                            ->required()
                                            // ->options(
                                            //     Customer::all()->pluck('name', 'id'),
                                            // )
                                            ->searchable()
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required(),
                                                TextInput::make('email')
                                                    ->required()
                                                    ->email(),
                                                TextInput::make('phone_number')
                                                    ->tel(),
                                                TextInput::make('mobile_phone_number')
                                                    ->required()
                                                    ->tel(),
                                            ]),
                                    ]),
                            ])
                            ->columnSpan(8),
                        Card::make()
                            ->schema([
                                Select::make('status_id')
                                    ->required()
                                    ->label('Status')
                                    ->options(Status::all()->pluck('name', 'id'))
                                    ->searchable(),
                                DatePicker::make('due_date')
                                    ->required(),
                                Select::make('payment_method_id')
                                    ->label('Payment Method')
                                    ->required()
                                    ->relationship('payment_method', 'bank_name'),
                            ])
                            ->columnSpan(4),
                        Section::make('Orders')
                            ->schema([
                                Repeater::make('orders')
                                    // ->relationship()
                                    ->schema([
                                        Select::make('product_id')
                                            ->required()
                                            ->label('Product')
                                            ->options(Product::all()->pluck('name', 'id'))
                                            ->searchable()
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                                $product = Product::find($state);
                                                $quantity = $get('quantity');

                                                $set('unit_price', $product->unit_price);

                                                $amount = ($product->unit_price * $quantity);
                                                $set('amount', $amount);
                                            }),
                                        TextInput::make('unit_price')
                                            ->numeric()
                                            ->reactive(),
                                        TextInput::make('quantity')
                                            ->required()
                                            ->numeric()
                                            ->default(1)
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                                $unitPrice = $get('unit_price');
                                                $quantity = $state;

                                                $amount = ($unitPrice * $quantity);
                                                $set('amount', $amount);
                                            }),
                                        TextInput::make('discount')
                                            ->required()
                                            ->numeric()
                                            ->default(0)
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                                $unitPrice = $get('unit_price');
                                                $quantity = $get('quantity');
                                                $discount = $state;

                                                $amount = ($unitPrice * $quantity) - $discount;
                                                $set('amount', $amount);
                                            }),
                                        TextInput::make('amount')
                                            ->reactive()
                                            ->numeric()
                                            ->columnSpanFull(),
                                    ])
                                    ->defaultItems(1)
                                    ->columnSpanFull()
                                    ->columns(2)
                                    ->label('Order')
                                    ->createItemButtonLabel('Add Order'),
                            ])
                            ->columnSpan(12),
                        Section::make('Total')
                            ->schema([
                                Placeholder::make('sub_total')
                                    ->label('Sub Total')
                                    ->content(function (callable $get, $set) {
                                        $subtotal = collect($get('orders'))->pluck('amount')->sum();
                                        return $subtotal ?? 0;
                                    }),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('discount')
                                            ->required()
                                            ->numeric()
                                            ->default(0)
                                            ->suffix('%')
                                            ->reactive(),
                                        TextInput::make('tax')
                                            ->required()
                                            ->numeric()
                                            ->default(0)
                                            ->reactive(),
                                    ]),
                                Placeholder::make('grand_total')
                                    ->label('Grand Total')
                                    ->content(function (callable $get, $set) {
                                        $subtotal = collect($get('orders'))->pluck('amount')->sum();
                                        $discount = $get('discount');
                                        $tax = $get('tax');
                                        $subtotal = intval($subtotal);
                                        $discount = intval($discount);
                                        $tax = intval($tax);

                                        $grandTotal = $subtotal - ($subtotal * ($discount / 100)) + ($subtotal - ($subtotal * ($discount / 100))) * ($tax / 100);

                                        return $grandTotal;
                                    }),
                                Textarea::make('note')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(12),
                    ]),
            ]);
    }

    public function save($model, Form $form)
    {
        // Save the parent model
        parent::save($model, $form);

        // Save the orders
        $orders = $form->getColumns('orders');
        foreach ($orders as $orderData) {
            // Create a new Order model
            $order = new Order([
                'product_id' => $orderData['product_id'],
                'unit_price' => $orderData['unit_price'],
                'quantity' => $orderData['quantity'],
                'amount' => $orderData['amount'],
            ]);
            $order->save();

            // Attach the Order model to the CustomerOrder model
            $model->orders()->save($order);
        }
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_id'),
                Tables\Columns\TextColumn::make('order_id'),
                Tables\Columns\TextColumn::make('payment_method_id'),
                Tables\Columns\TextColumn::make('status_id'),
                Tables\Columns\TextColumn::make('due_date')
                    ->date(),
                Tables\Columns\TextColumn::make('discount'),
                Tables\Columns\TextColumn::make('sub_total'),
                Tables\Columns\TextColumn::make('tax'),
                Tables\Columns\TextColumn::make('grand_total'),
                Tables\Columns\TextColumn::make('note'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerOrders::route('/'),
            'create' => Pages\CreateCustomerOrder::route('/create'),
            'edit' => Pages\EditCustomerOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNextInvoiceNumber()
    {
        $lastId = CustomerOrder::latest()->value('id');
        $nextInvoiceNumber = 'INV-' . date('Y-m-d') . '/' . $lastId + 1;

        return $nextInvoiceNumber;
    }
}
