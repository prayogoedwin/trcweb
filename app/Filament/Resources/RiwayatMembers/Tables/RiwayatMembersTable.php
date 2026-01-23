<?php

namespace App\Filament\Resources\RiwayatMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RiwayatMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member.name'),
                TextColumn::make('type')
                    ->icon(
                        fn($state) => $state === 'withdraw'
                            ? 'heroicon-o-arrow-up-circle'
                            : 'heroicon-o-arrow-down-circle'
                    )
                    ->color(fn($state) => $state == 'withdraw' ? 'danger' : 'success'),
                TextColumn::make('nominal')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state == 0 ? 'Belum Verifikasi' : 'Terverifikasi')
                    ->color(fn($state) => $state == 0 ? 'warning' : 'success')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
