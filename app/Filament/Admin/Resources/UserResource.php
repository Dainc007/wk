<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

final class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->visibleOn('create')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->dehydrated(fn ($state): bool => ! blank($state)),
                Select::make('roles')->multiple()->relationship('roles', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Impersonate::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => UserResource\Pages\ListUsers::route('/'),
            'create' => UserResource\Pages\CreateUser::route('/create'),
            'edit' => UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
