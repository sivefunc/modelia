<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Filament\Resources\ProfileResource\RelationManagers;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Set;
use Filament\Forms\Get;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Subregion;
use Illuminate\Support\Collection;

use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Profile';
    protected static ?string $modelLabel = 'Profiles';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User name and Balance')
                    ->description('You must not leave fields in blank')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('balance')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                    ])->columns(2),
                Forms\Components\Section::make('Location')
                    ->description('You must not leave fields in blank')
                    ->schema([
                        Forms\Components\Select::make('region_id')
                            ->relationship('region', 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('state_id', null);
                                $set('city_id', null);
                                $set('country_id', null);
                                $set('subregion_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('subregion_id')
                            ->options(
                                fn(Get $get): Collection => Subregion::query()
                                    ->where('region_id', $get('region_id'))
                                    ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('state_id', null);
                                $set('city_id', null);
                                $set('country_id', null);
                            })
                            ->required(),

                        Forms\Components\Select::make('country_id')
                            ->options(
                                fn(Get $get): Collection => Country::query()
                                    ->where('subregion_id', $get('subregion_id'))
                                    ->pluck('name', 'id'))

                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('state_id', null);
                                $set('city_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('state_id')
                            ->options(
                                fn(Get $get): Collection => State::query()
                                    ->where('country_id', $get('country_id'))
                                    ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('city_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('city_id')
                            ->options(
                                fn(Get $get): Collection => City::query()
                                    ->where('state_id', $get('state_id'))
                                    ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                   ])->columns(5),
                Forms\Components\Section::make('Profile names')
                    ->description('You must not leave fields in blank')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Dates')
                    ->description('You must not leave fields in blank')
                    ->schema([
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->required(),
                    ])->columns(1),
             ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('balance')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('region.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('subregion.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('country.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('city.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_uploads')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('daily_uploads')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
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
                    ->indicator('Region'),
                \Filament\Tables\Filters\SelectFilter::make('Country')
                    ->relationship('country', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Filter by Country')
                    ->indicator('Country'),
                \Filament\Tables\Filters\SelectFilter::make('State')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Filter by State')
                    ->indicator('State'),
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
                Infolists\Components\Section::make('User name and balance')
                    ->schema([
                        Infolists\Components\TextEntry::make('name'),
                        Infolists\Components\TextEntry::make('balance')
                    ])->columns(2),
                Infolists\Components\Section::make('Location')
                    ->schema([
                        Infolists\Components\TextEntry::make('region.name'),
                        Infolists\Components\TextEntry::make('subregion.name'),
                        Infolists\Components\TextEntry::make('country.name'),
                        Infolists\Components\TextEntry::make('state.name'),
                        Infolists\Components\TextEntry::make('city.name'),
                    ])->columns(5),
                Infolists\Components\Section::make('Profile names')
                    ->schema([
                        Infolists\Components\TextEntry::make('first_name'),
                        Infolists\Components\TextEntry::make('last_name'),
                    ])->columns(2),
                Infolists\Components\Section::make('Profile names')
                    ->schema([
                        Infolists\Components\TextEntry::make('date_of_birth'),
                    ])->columns(1),

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
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'view' => Pages\ViewProfile::route('/{record}'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
