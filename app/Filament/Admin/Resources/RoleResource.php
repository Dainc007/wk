<?php
//
//namespace App\Filament\Admin\Resources;
//
//use App\Filament\Resources\RoleResource\Pages;
//use App\Models\Role;
//use Filament\Forms;
//use Filament\Forms\Form;
//use Filament\Resources\Resource;
//use Filament\Tables;
//use Filament\Tables\Table;
//
//class RoleResource extends Resource
//{
//    protected static ?string $model = Role::class;
//
//    protected static ?string $navigationIcon = 'heroicon-o-key';
//
//    protected static ?string $navigationGroup = 'Access Management';
//
//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                Forms\Components\TextInput::make('name')
//                    ->required()
//                    ->unique(ignoreRecord: true)
//                    ->placeholder('Enter role name'),
//
//                Forms\Components\Select::make('permissions')
//                    ->multiple()
//                    ->relationship('permissions', 'name')
//                    ->searchable()
//                    ->preload(),
//            ]);
//    }
//
//    public static function table(Table $table): Table
//    {
//        return $table
//            ->columns([
//                Tables\Columns\TextColumn::make('name')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('permissions_count')
//                    ->counts('permissions')
//                    ->label('Permissions'),
//            ])
//            ->filters([
//                //
//            ])
//            ->actions([
//                Tables\Actions\EditAction::make(),
//            ])
//            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
//            ]);
//    }
//
//    public static function getRelations(): array
//    {
//        return [
//            //
//        ];
//    }
//
//    public static function getPages(): array
//    {
//        return [
//            'index' => \App\Filament\Admin\Resources\RoleResource\Pages\ListRoles::route('/'),
//            'create' => \App\Filament\Admin\Resources\RoleResource\Pages\CreateRole::route('/create'),
//            'edit' => \App\Filament\Admin\Resources\RoleResource\Pages\EditRole::route('/{record}/edit'),
//        ];
//    }
//}
