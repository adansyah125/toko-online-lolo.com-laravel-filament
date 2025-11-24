<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Informasi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InformasiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InformasiResource\RelationManagers;

class InformasiResource extends Resource
{
    protected static ?string $model = Informasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Informasi';

    public static function getPluralLabel(): string
    {
        return 'Informasi';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('video')
                    ->directory('informasi')
                    ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg'])
                    ->required()
                    ->maxSize(51200) // max 50MB
                    ->label('Video'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('video')
                    ->label('Video File')
                    ->formatStateUsing(fn($state) => basename($state)),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListInformasis::route('/'),
            'create' => Pages\CreateInformasi::route('/create'),
            'edit' => Pages\EditInformasi::route('/{record}/edit'),
        ];
    }
}
