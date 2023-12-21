<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PanierResource\Pages;
use App\Filament\Resources\PanierResource\RelationManagers;
use App\Models\Panier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PanierResource extends Resource
{
    protected static ?string $model = Panier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('produit_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_commande')
                    ->required(),
                Forms\Components\TextInput::make('etat_commande')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('quantite')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('prix_total')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('produit_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_commande')
                    ->boolean(),
                Tables\Columns\TextColumn::make('etat_commande')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantite')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('prix_total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPaniers::route('/'),
            'create' => Pages\CreatePanier::route('/create'),
            'view' => Pages\ViewPanier::route('/{record}'),
            'edit' => Pages\EditPanier::route('/{record}/edit'),
        ];
    }
}
