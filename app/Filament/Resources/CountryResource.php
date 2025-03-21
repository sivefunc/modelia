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

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('iso3')
                    ->maxLength(3),
                Forms\Components\TextInput::make('numeric_code')
                    ->maxLength(3),
                Forms\Components\TextInput::make('iso2')
                    ->maxLength(2),
                Forms\Components\TextInput::make('phonecode')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('capital')
                    ->maxLength(255),
                Forms\Components\TextInput::make('currency')
                    ->maxLength(255),
                Forms\Components\TextInput::make('currency_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('currency_symbol')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tld')
                    ->maxLength(255),
                Forms\Components\TextInput::make('native')
                    ->maxLength(255),
                Forms\Components\TextInput::make('region_name')
                    ->maxLength(255),
                Forms\Components\Select::make('region_id')
                    ->relationship('region', 'name'),
                Forms\Components\TextInput::make('subregion_name')
                    ->maxLength(255),
                Forms\Components\Select::make('subregion_id')
                    ->relationship('subregion', 'name'),
                Forms\Components\TextInput::make('nationality')
                    ->maxLength(255),
                Forms\Components\Textarea::make('timezones')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('translations')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('latitude')
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->numeric(),
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phonecode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capital')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tld')
                    ->searchable(),
                Tables\Columns\TextColumn::make('native')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subregion_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subregion.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nationality')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('emoji')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emojiU')
                    ->searchable(),
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('wikiDataId')
                    ->searchable(),
            ])
            ->filters([
                //
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
