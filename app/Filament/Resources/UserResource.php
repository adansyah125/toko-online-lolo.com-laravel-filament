<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    // protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationLabel = 'Pengguna';


    public static function getPluralLabel(): string
    {
        return 'User';
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('email'),
                TextInput::make('password')
                    ->password()
                    ->live()
                    ->revealable(),
                Textarea::make('alamat'),
                TextInput::make('no_telp'),
                Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('email')
                    ->alignCenter(),
                TextColumn::make('alamat')
                    ->alignCenter()
                    ->placeholder('-'),
                TextColumn::make('no_telp')
                    ->alignCenter()
                    ->placeholder('-'),
                TextColumn::make('role')
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->alignCenter()
                    ->label('dibuat')
                    ->formatStateUsing(fn(string $state): string => Carbon::make($state)->format('d F Y')),

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
