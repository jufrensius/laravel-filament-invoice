<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?string $navigationGroup = 'Customers';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)
                    ->schema([
                        Section::make('customer')
                            ->schema([
                                Wizard::make()
                                    ->schema([
                                        Step::make('contact')
                                            ->schema([
                                                TextInput::make('name')
                                                    ->required(),
                                                TextInput::make('email')
                                                    ->required()
                                                    ->email(),
                                                Grid::make(2)
                                                    ->schema([
                                                        TextInput::make('phone_number')
                                                            ->tel(),
                                                        TextInput::make('mobile_phone_number')
                                                            ->required()
                                                            ->tel(),
                                                    ]),
                                            ]),
                                        Step::make('address')
                                            ->schema([
                                                Textarea::make('street'),
                                                TextInput::make('state'),
                                                TextInput::make('city'),
                                                TextInput::make('postal_code'),
                                            ]),
                                    ]),
                            ])
                            ->columnSpan(8),
                        Grid::make(12)
                            ->schema([
                                Section::make('Customer Categories')
                                    ->schema([
                                        Select::make('customer_categories')
                                            ->label('Categories')
                                            ->multiple()
                                            ->relationship('customer_categories', 'name')
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required()
                                                    ->reactive()
                                                    ->afterStateUpdated(function ($state, callable $set) {
                                                        $set('slug', Str::slug($state));
                                                    }),
                                                TextInput::make('slug'),
                                                Select::make('parent_customer_category_id')
                                                    ->label('Parent')
                                                    ->relationship('parent', 'name')
                                                    ->searchable(),
                                            ]),
                                    ]),
                                Section::make('Customer Tags')
                                    ->schema([
                                        Select::make('customer_tags')
                                            ->label('Tags')
                                            ->multiple()
                                            ->relationship('customer_tags', 'name')
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->unique('customer_tags', 'name')
                                                    ->placeholder(__('Enter tags'))
                                                    ->reactive()
                                                    ->afterStateUpdated(function ($state, callable $set) {
                                                        $set('slug', Str::slug($state));
                                                    }),
                                                TextInput::make('slug'),
                                            ]),
                                    ]),
                            ])
                            ->columnSpan(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('email')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('mobile_phone_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('customer_categories.name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('customer_tags.name')
                    ->searchable()
                    ->toggleable(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
