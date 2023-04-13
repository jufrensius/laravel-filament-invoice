<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerOrderResource\Pages;
use App\Filament\Resources\CustomerOrderResource\RelationManagers;
use App\Models\Customer;
use App\Models\CustomerOrder;
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
                Card::make()
                    ->schema([
                        TextInput::make('invoice_number')
                            ->default(static::getNextInvoiceNumber()),
                        Grid::make(2)
                            ->schema([
                                Select::make('customers')
                                    ->label('Customer')
                                    ->required()
                                    // ->options(Customer::all()->pluck('name', 'id'))
                                    // ->relationship('customers', 'name')
                                    // ->multiple()
                                    ->options(
                                        Customer::all()->pluck('name', 'id'),
                                    )
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
                                DatePicker::make('due_date')
                                    ->required(),
                                Select::make('payment_method_id')
                                    ->label('Payment Method')
                                    ->required()
                                    ->relationship('payment_methods', 'bank_name'),
                                Select::make('status_id')
                                    ->required()
                                    ->label('Status')
                                    ->options(Status::all()->pluck('name', 'id'))
                                    ->searchable(),
                            ]),
                        Repeater::make('orders')
                            ->schema([
                                Select::make('product_id')
                                    ->required()
                                    ->label('Product')
                                    ->options(Product::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, $get) {
                                        $product = Product::find($state);
                                        $set('unit_price', $product->unit_price);
                                        $set('amount', $product->amount);
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
                                        $discount = $get('discount');

                                        $amount = ($unitPrice * $quantity) - $discount;
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
                        Placeholder::make('subtotal')
                            ->label('Sub Total')
                            ->content(function ($get) {
                                return collect($get('order_id'))
                                    ->pluck('amount')
                                    ->sum();
                            }),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('discount')
                                    ->required()
                                    ->afterStateUpdated(function ($state, callable $set, $get) {
                                        $subtotal = $get('subtotal');
                                        $discount = $state / 100 * $subtotal;
                                        $grandTotal = $subtotal - $discount;
                                        $tax = $get('tax', 0);
                                        $grandTotal += $grandTotal * $tax / 100;

                                        $set('grand_total', $grandTotal);
                                    }),
                                TextInput::make('tax')
                                    ->required(),
                            ]),
                        Placeholder::make('grand_total')
                            ->label('Grand Total'),
                        Textarea::make('note')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ]),
            ]);
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
                Tables\Columns\TextColumn::make('subtotal'),
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
        $lastId = CustomerOrder::orderBy('id')->value('id');

        $nextInvoiceNumber = 'INV-' . date('Y-m-d') . '/' . $lastId + 1;

        return $nextInvoiceNumber;
    }
}
