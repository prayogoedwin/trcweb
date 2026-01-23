<?php

namespace App\Filament\Resources\RiwayatMembers;

use App\Filament\Resources\RiwayatMembers\Pages\CreateRiwayatMember;
use App\Filament\Resources\RiwayatMembers\Pages\EditRiwayatMember;
use App\Filament\Resources\RiwayatMembers\Pages\ListRiwayatMembers;
use App\Filament\Resources\RiwayatMembers\Schemas\RiwayatMemberForm;
use App\Filament\Resources\RiwayatMembers\Tables\RiwayatMembersTable;
use App\Models\Wallet;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RiwayatMemberResource extends Resource
{
    protected static ?string $model = Wallet::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | \UnitEnum | null $navigationGroup = 'Member';

    protected static ?string $modelLabel = 'Riwayat Member';
    protected static ?string $pluralModelLabel = 'Riwayat Member';

    public static function form(Schema $schema): Schema
    {
        return RiwayatMemberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RiwayatMembersTable::configure($table);
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
            'index' => ListRiwayatMembers::route('/'),
            'create' => CreateRiwayatMember::route('/create'),
            'edit' => EditRiwayatMember::route('/{record}/edit'),
        ];
    }
}
