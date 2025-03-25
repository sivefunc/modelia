<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageResource\Pages;
use App\Filament\Resources\ImageResource\RelationManagers;
use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Collection;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Support\Facades\Storage;

class ImageResource extends Resource
{
    protected static ?string $model = Image::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Image';
    protected static ?string $modelLabel = 'Images';
    protected static ?string $navigationGroup = 'Image Management';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Profile')
                    ->description('You must not leave fields in blank')
                    ->schema([
                        Forms\Components\Select::make('profile_id')
                            ->options(
                                fn (): Collection => 
                                \App\Models\User::query()
                                    ->join(
                                        'profiles',
                                        'profiles.user_id',
                                        '=',
                                        'users.id'
                                    )
                                    ->select('users.id', 'users.name')
                                    ->get()
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])->columns(1),
                Forms\Components\Section::make('Image Input')
                    ->description('You must not leave fields in blank')
                    ->schema([
                        Forms\Components\Select::make('generative_model_id')
                            ->relationship('generative_model', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('prompt')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
                Forms\Components\Section::make('Image Output')
                    ->description('You must not leave fields in blank')
                    ->schema([
                        Forms\Components\TextInput::make('link')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('photo_size')
                            ->required()
                            ->numeric(),
                        Forms\Components\FileUpload::make('attachment')
                            ->required()
                            ->preserveFilenames()
                            ->maxSize(2048),
                        Forms\Components\TextInput::make('type')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('resolution')
                            ->required()
                            ->maxLength(255),
                    ])->columns(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('profile.user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('generative_model.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('attachment')
                    ->sortable()
                    ->defaultImageUrl(
                        url('images/placeholder.png')
                    ),
                Tables\Columns\TextColumn::make('link')
                    ->searchable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('photo_size')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('resolution')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('views')
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
                //
                SelectFilter::make('profile_id')
                    ->options(
                        fn (): Collection => 
                        \App\Models\User::query()
                            ->join(
                                'profiles',
                                'profiles.user_id',
                                '=',
                                'users.id'
                            )
                            ->select('users.id', 'users.name')
                            ->get()
                            ->pluck('name', 'id')
                    )
                    ->searchable()
                    ->preload()
                    ->label('Filter by Profile')
                    ->indicator('Profile'),
                SelectFilter::make('GenerativeModel')
                    ->relationship('generative_model', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Filter by Generative Model')
                    ->indicator('GenerativeModel'),
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
                Section::make('Profile')
                    ->schema([
                        TextEntry::make('profile.user.name'),
                    ])->columns(1),
                Section::make('Image Input')
                    ->schema([
                        TextEntry::make('generative_model.name'),
                        TextEntry::make('prompt'),
                    ])->columns(2),
                Section::make('Image Output')
                    ->schema([
                        TextEntry::make('link'),
                        TextEntry::make('photo_size'),
                        TextEntry::make('resolution'),
                        TextEntry::make('type'),
                        ImageEntry::make('attachment')
                            ->square()
                            ->defaultImageUrl(
                                url('images/placeholder.png')
                            ),
                    ])->columns(5),
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
            'index' => Pages\ListImages::route('/'),
            'create' => Pages\CreateImage::route('/create'),
            'view' => Pages\ViewImage::route('/{record}'),
            'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }
}
