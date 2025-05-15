<?php

namespace App\Filament\Admin\Resources;

use App\Enums\PitchRoles;
use App\Filament\Admin\Resources\TeamUserResource\Pages;
use App\Filament\Admin\Resources\TeamUserResource\RelationManagers;
use App\Filament\Traits\HasTranslatedLabels;
use App\Models\TeamUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamUserResource extends Resource
{
    use HasTranslatedLabels;

    protected static ?string $model = TeamUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Competitions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('team_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('status')
                ,
                Forms\Components\Select::make('pitch_role')
                    ->options(PitchRoles::class),
                Forms\Components\DateTimePicker::make('contract_signed_at'),
                Forms\Components\DateTimePicker::make('contract_terminated_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('team.name'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('status')
                ->badge(),
                Tables\Columns\TextColumn::make('pitch_role')
                    ->badge(),
                Tables\Columns\TextColumn::make('contract_signed_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('contract_terminated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListTeamUsers::route('/'),
            'create' => Pages\CreateTeamUser::route('/create'),
            'edit' => Pages\EditTeamUser::route('/{record}/edit'),
        ];
    }
}
