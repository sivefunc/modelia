<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GenerativeModelResource\Pages;
use App\Filament\Resources\GenerativeModelResource\RelationManagers;
use App\Models\GenerativeModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

use Illuminate\Database\Eloquent\Model;

class GenerativeModelResource extends Resource
{
    protected static ?string $model = GenerativeModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';
    protected static ?string $navigationLabel = 'Generative Model';
    protected static ?string $modelLabel = 'Generative Models';
    protected static ?string $navigationGroup = 'Image Management';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Model info')
                    ->description('You should not leave fields blank')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cost')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('endpoint')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cost')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('endpoint')
                    ->searchable(),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Generative Model Info')
                    ->schema([
                        TextEntry::make('name')->label('Model Name'),
                        TextEntry::make('cost')->label('Model Cost'),
                        TextEntry::make('endpoint')->label('Model Endpoint'),
                    ])->columns(3),
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
            'index' => Pages\ListGenerativeModels::route('/'),
            'create' => Pages\CreateGenerativeModel::route('/create'),
            'view' => Pages\ViewGenerativeModel::route('/{record}'),
            'edit' => Pages\EditGenerativeModel::route('/{record}/edit'),
        ];
    }
}
