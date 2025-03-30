<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;

use Illuminate\Support\HtmlString;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Country';
    protected static ?string $modelLabel = 'Countries';
    protected static ?string $navigationGroup = 'Address Management';
    protected static ?int $navigationSort = 3;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Global')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('capital')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nationality')
                            ->maxLength(255),
                    ])->columns(3),
                Forms\Components\Section::make('Location')
                    ->schema([
                        Forms\Components\Select::make('region_id')
                            ->relationship('region', 'name'),
                        Forms\Components\Select::make('subregion_id')
                            ->relationship('subregion', 'name'),
                        Forms\Components\TextInput::make('latitude')
                            ->numeric(),
                        Forms\Components\TextInput::make('longitude')
                            ->numeric(),
                        Forms\Components\Textarea::make('timezones')
                            ->columnSpanFull(),
                    ])->columns(5),

                Forms\Components\Section::make('Currency')
                    ->schema([
                        Forms\Components\TextInput::make('currency')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('currency_name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('currency_symbol')
                            ->maxLength(255),
                    ])->columns(3),
                Forms\Components\Section::make('Country Codes')
                    ->schema([
                        Forms\Components\TextInput::make('iso3')
                            ->maxLength(3),
                        Forms\Components\TextInput::make('numeric_code')
                            ->maxLength(3),
                        Forms\Components\TextInput::make('iso2')
                            ->maxLength(2),
                        Forms\Components\TextInput::make('phonecode')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tld')
                            ->maxLength(255),
                    ])->columns(5),
                Forms\Components\Section::make('Language')
                    ->schema([
                        Forms\Components\Textarea::make('translations')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('native')
                            ->maxLength(255),
                    ])->columns(2),
                Forms\Components\Section::make('More data')
                    ->schema([
                        Forms\Components\TextInput::make('emoji')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('emojiU')
                            ->maxLength(191),
                        Forms\Components\TextInput::make('flag')
                            ->required()
                            ->numeric()
                            ->default(1),
                        Forms\Components\TextInput::make('wikiDataId')
                            ->maxLength(255),
                    ])->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso3')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numeric_code')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('iso2')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phonecode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capital')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('currency_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tld')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('native')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('region.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('subregion.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nationality')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('emoji')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emojiU')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('flag')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('wikiDataId')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('Region')
                    ->relationship('region', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Filter by Region')
                    ->indicator('Region'),
                \Filament\Tables\Filters\SelectFilter::make('Subregion')
                    ->relationship('subregion', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Filter by Subregion')
                    ->indicator('Subregion')

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Global')
                    ->schema([
                        Infolists\Components\TextEntry::make('name'),
                        Infolists\Components\TextEntry::make('capital'),
                        Infolists\Components\TextEntry::make('nationality')
                    ])->columns(3),
                Infolists\Components\Section::make('Location')
                    ->schema([
                        Infolists\Components\TextEntry::make('region.name'),
                        Infolists\Components\TextEntry::make('subregion.name'),
                        Infolists\Components\TextEntry::make('latitude'),
                        Infolists\Components\TextEntry::make('longitude'),
                        Infolists\Components\TextEntry::make('timezones')
                            ->limit(30)
                            ->copyable()
                            ->copyMessage('Copied!')
                    ])->columns(5),

                Infolists\Components\Section::make('Currency')
                    ->schema([
                        Infolists\Components\TextEntry::make('currency'),
                        Infolists\Components\TextEntry::make('currency_name'),
                        Infolists\Components\TextEntry::make('currency_symbol'),
                    ])->columns(3),
                Infolists\Components\Section::make('Country Codes')
                    ->schema([
                        Infolists\Components\TextEntry::make('iso3'),
                        Infolists\Components\TextEntry::make('numeric_code'),
                        Infolists\Components\TextEntry::make('iso2'),
                        Infolists\Components\TextEntry::make('phonecode'),
                        Infolists\Components\TextEntry::make('tld')
                    ])->columns(5),
                Infolists\Components\Section::make('Language')
                    ->schema([
                        Infolists\Components\TextEntry::make('translations')
                            ->limit(30)
                            ->copyable()
                            ->copyMessage('Copied!'),
                        Infolists\Components\TextEntry::make('native')
                    ])->columns(2),
                Infolists\Components\Section::make('More data')
                    ->schema([
                        Infolists\Components\TextEntry::make('emoji'),
                        Infolists\Components\TextEntry::make('emojiU'),
                        Infolists\Components\TextEntry::make('flag'),
                        Infolists\Components\TextEntry::make('wikiDataId')
                    ])->columns(4)
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'view' => Pages\ViewCountry::route('/{record}'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
