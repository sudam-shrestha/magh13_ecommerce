<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Imports\CompanyImport;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('import')
                ->form([
                    FileUpload::make('csv')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $path = public_path('storage/' . $data['csv']);

                    Excel::import(new CompanyImport, $path);
                })
                ->label('Import Company'),

            Actions\CreateAction::make(),
        ];
    }
}
