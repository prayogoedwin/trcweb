<?php

namespace App\Filament\Resources\Trades\Tables;

use App\Services\TradeService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member.name')
                    ->sortable(),
                TextColumn::make('modal')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0))
                    ->sortable(),
                TextColumn::make('profit_percent')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cancel_fee_percent')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'gray',
                        default => 'secondary',
                    }),
                TextColumn::make('cancel_fee_amount')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0))
                    ->sortable(),
                TextColumn::make('started_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('cancelled_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('last_profit_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
                Action::make('cancel')
                    ->label('Batalkan')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->icon('heroicon-s-x-circle')
                    ->visible(fn($record) => $record->status == 'active')
                    ->action(function ($record) {
                        TradeService::cancelTrade($record);
                    }),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
