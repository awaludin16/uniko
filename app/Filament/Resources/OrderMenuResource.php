<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderMenuResource\Pages;
use App\Filament\Resources\OrderMenuResource\RelationManagers;
use App\Models\OrderMenu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderMenuResource extends Resource
{
    public static function shouldRegisterNavigation(): bool {
        return auth()->user()->role === "cashier";
    }

    public static function canAccess(): bool {
        return auth()->user()->role === "cashier";
    }
    
    protected static ?string $model = OrderMenu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Transactions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('order_id')
                    ->label('Order')
                    ->relationship('order', 'id') // Assuming you have a relationship defined in the OrderMenu model
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('menu_id')
                    ->label('Menu')
                    ->relationship('menu', 'name') // Assuming you have a relationship defined in the OrderMenu model
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->required()
                    ->numeric()
                    ->minValue(1),
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->numeric()
                    ->minValue(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('order.id')->label('Order ID')->sortable(), // Menampilkan ID Order
                Tables\Columns\TextColumn::make('menu.name')->label('Menu')->sortable(), // Menampilkan nama Menu
                Tables\Columns\TextColumn::make('quantity')->sortable(),
                Tables\Columns\TextColumn::make('price')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->filters([
                // Anda dapat menambahkan filter di sini jika diperlukan
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
            'index' => Pages\ListOrderMenus::route('/'),
            'create' => Pages\CreateOrderMenu::route('/create'),
            'edit' => Pages\EditOrderMenu::route('/{record}/edit'),
        ];
    }
}
