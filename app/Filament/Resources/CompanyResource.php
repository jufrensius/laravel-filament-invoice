<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;
    protected static ?string $navigationGroup = 'Companies';
    protected static ?string $navigationIcon = 'heroicon-o-office-building';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)
                    ->schema([
                        Section::make('company')
                            ->schema([
                                Card::make()
                                    ->schema([
                                        Wizard::make()
                                            ->schema([
                                                Step::make('General')
                                                    ->schema([
                                                        FileUpload::make('logo')
                                                            ->image()
                                                            ->imageResizeMode('cover')
                                                            ->imageCropAspectRatio('16:9')
                                                            ->imageResizeTargetWidth('1920')
                                                            ->imageResizeTargetHeight('1080'),
                                                        TextInput::make('name')
                                                            ->required(),
                                                    ]),
                                                Step::make('Contact')
                                                    ->schema([
                                                        TextInput::make('email')
                                                            ->required()
                                                            ->email(),
                                                        Grid::make(2)
                                                            ->schema([
                                                                TextInput::make('phone_number')
                                                                    ->required()
                                                                    ->tel(),
                                                                TextInput::make('mobile_phone_number')
                                                                    ->required()
                                                                    ->tel(),
                                                            ]),
                                                    ]),
                                                Step::make('Address')
                                                    ->schema([
                                                        Textarea::make('street'),
                                                        TextInput::make('state'),
                                                        TextInput::make('city'),
                                                        TextInput::make('postal_code'),
                                                    ]),
                                                Step::make('Contact Person')
                                                    ->schema([
                                                        Select::make('customers')
                                                            ->label('Customer')
                                                            ->multiple()
                                                            ->relationship('customers', 'name')
                                                            ->createOptionForm([
                                                                TextInput::make('name')
                                                                    ->required(),
                                                                TextInput::make('email')
                                                                    ->required()
                                                                    ->email(),
                                                                TextInput::make('phone_number')
                                                                    ->tel()
                                                                    ->nullable(),
                                                                TextInput::make('mobile_phone_number')
                                                                    ->required()
                                                                    ->tel(),
                                                                TextInput::make('position')
                                                                    ->required(),
                                                            ]),
                                                    ]),
                                            ]),
                                    ]),
                            ])
                            ->columnSpan(8),
                        Grid::make(12)
                            ->schema([
                                Section::make('Company Categories')
                                    ->schema([
                                        Select::make('company_categories')
                                            ->label('Categories')
                                            ->multiple()
                                            ->relationship('company_categories', 'name')
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required()
                                                    ->reactive()
                                                    ->afterStateUpdated(function ($state, callable $set) {
                                                        $set('slug', Str::slug($state));
                                                    }),
                                                TextInput::make('slug'),
                                                Select::make('parent_company_category')
                                                    ->label('Parent')
                                                    ->relationship('parent', 'name')
                                                    ->searchable(),
                                            ]),
                                    ]),
                                Section::make('Company Tags')
                                    ->schema([
                                        Select::make('company_tags')
                                            ->label('Tags')
                                            ->multiple()
                                            ->relationship('company_tags', 'name')
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->unique('company_tags', 'name')
                                                    ->reactive()
                                                    ->afterStateUpdated(function ($state, callable $set) {
                                                        $set('slug', Str::slug($state));
                                                    }),
                                                TextInput::make('slug'),
                                            ]),
                                    ]),
                            ])
                            ->columnSpan(4)
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('mobile_phone_number')
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
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
