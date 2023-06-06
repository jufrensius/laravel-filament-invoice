<?php

namespace App\Filament\Resources;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductTag;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Products';
    protected static ?string $navigationIcon = 'heroicon-o-view-grid';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('unit_price')
                                    ->required()
                                    ->numeric(),
                                Textarea::make('description'),
                            ])
                            ->columnSpan(8),
                        Grid::make(12)
                            ->schema([
                                Section::make('Product Categories')
                                    ->schema([
                                        Select::make('product_categories')
                                            ->label('Categories')
                                            ->multiple()
                                            ->relationship('product_categories', 'name')
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required()
                                                    ->reactive()
                                                    ->afterStateUpdated(function ($state, callable $set) {
                                                        $set('slug', Str::slug($state));
                                                    }),
                                                TextInput::make('slug'),
                                                Select::make('parent_product_category_id')
                                                    ->label('Parent')
                                                    ->relationship('parent', 'name')
                                                    ->searchable(),
                                            ]),
                                    ]),
                                Section::make('Product Tags')
                                    ->schema([
                                        Select::make('product_tags')
                                            ->label('Tags')
                                            ->multiple()
                                            ->relationship('product_tags', 'name')
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->unique('product_tags', 'name')
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
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('unit_price')
                    ->money('idr')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('product_categories.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('product_tags.name')
                    ->sortable()
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
