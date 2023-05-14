<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpiderResource\Pages;
use App\Models\Spider;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SpiderResource extends Resource
{
    protected static ?string $model = Spider::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('shop_id')
                    ->required()
                    ->relationship('shop', 'title'),
                Forms\Components\KeyValue::make('product_filter')
                    ->keyLabel('Attribute')
                    ->valueLabel('Selector')
                    ->default([
                        'title' => '',
                        'image' => '',
                        'description' => '',
                        'price' => '',
                        'shop_link' => '',
                        'category' => '',
                        'brand' => ''
                    ])->disableAddingRows()
                    ->disableEditingKeys()
                    ->disableDeletingRows()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('shop.title'),
                Tables\Columns\TextColumn::make('created_at')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

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
            'index' => Pages\ListSpiders::route('/'),
            'create' => Pages\CreateSpider::route('/create'),
            'edit' => Pages\EditSpider::route('/{record}/edit'),
        ];
    }
}
