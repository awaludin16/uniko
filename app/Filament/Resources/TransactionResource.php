<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transactions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Cashier')
                    ->relationship('cashier', 'name', fn ($query) => $query->where('role', 'cashier')) // Asumsikan ada relasi 'user' di model Transaction
                    ->required(),

                Forms\Components\Select::make('order_id')
                    ->label('Order ID')
                    ->relationship('order', 'id') // Asumsikan ada relasi 'order' di model Transaction
                    ->required(),

                Forms\Components\Select::make('payment_id')
                    ->label('Payment ID')
                    ->relationship('payment', 'id') // Asumsikan ada relasi 'order' di model Transaction
                    ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('cashier.name')
                    ->label('Cashier')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment.id')
                    ->label('Payment ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('order.id')
                    ->label('Order ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('order.status')
                    ->label('Order Status')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment.method')
                    ->label('Payment Method')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment.amount')
                    ->label('Payment Total')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
