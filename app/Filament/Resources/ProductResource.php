<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = ' Produk';

    public static function getPluralLabel(): string
    {
        return 'Produk';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationGroup = 'Menu';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->relationship('Category', 'nama')
                    ->label('Kategori')
                    ->required(),
                TextInput::make('nama')
                    ->label('Nama Produk')
                    ->required(),
                TextInput::make('stok')
                    ->numeric()
                    ->integer(),
                // ->step(1)
                TextArea::make('deskripsi')
                    ->required(),
                TextInput::make('harga')
                    ->required(),
                FileUpload::make('image1')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->required(),

                FileUpload::make('image2')
                    ->image()
                    ->disk('public')
                    ->directory('products'),

                FileUpload::make('image3')
                    ->image()
                    ->disk('public')
                    ->directory('products'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                ImageColumn::make('image1')
                    ->label('Gambar')
                    ->circular()
                    ->alignCenter(),
                ImageColumn::make('image2')
                    ->label('Gambar')
                    ->circular()
                    ->alignCenter(),
                ImageColumn::make('image3')
                    ->label('Gambar')
                    ->circular()
                    ->alignCenter(),
                TextColumn::make('nama')
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.nama')
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('stok')
                    ->alignCenter(),
                TextColumn::make('harga')
                    ->alignCenter()
                    ->money('IDR', locale: 'ID'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function beforeDelete($record)
    {
        foreach (['image1', 'image2', 'image3'] as $image) {
            if ($record->$image && Storage::disk('public')->exists($record->$image)) {
                Storage::disk('public')->delete($record->$image);
            }
        }
    }
}
