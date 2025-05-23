<?php
//
//namespace App\Filament\Admin\Resources;
//
//use App\Filament\Resources\PermissionResource\Pages;
//use App\Models\Permission;
//use Filament\Forms;
//use Filament\Forms\Form;
//use Filament\Resources\Resource;
//use Filament\Tables;
//use Filament\Tables\Table;
//
//class PermissionResource extends Resource
//{
//    protected static ?string $model = Permission::class;
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
//                    ->placeholder('Enter permission name'),
//            ]);
//    }
//
//    public static function table(Table $table): Table
//    {
//        return $table
//            ->columns([
//                Tables\Columns\TextColumn::make('name')
//                    ->searchable(),
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
//            'index' => \App\Filament\Admin\Resources\PermissionResource\Pages\ListPermissions::route('/'),
//            'create' => \App\Filament\Admin\Resources\PermissionResource\Pages\CreatePermission::route('/create'),
//            'edit' => \App\Filament\Admin\Resources\PermissionResource\Pages\EditPermission::route('/{record}/edit'),
//        ];
//    }
//}
