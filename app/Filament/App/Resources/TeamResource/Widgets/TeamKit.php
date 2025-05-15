<?php

namespace App\Filament\App\Resources\TeamResource\Widgets;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\Widget;
use Filament\Forms\Form;
class TeamKit extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.app.resources.team-resource.widgets.team-kit';
    public ?array $data = [];
    protected int | string | array $columnSpan = 1;

    public function mount(): void
    {
        $this->form->fill();
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Kit')
                    ->tabs([
                        Tabs\Tab::make('Home')
                            ->schema([
                                Section::make()
                                    ->columns(3)
                                    ->schema([
                                        ColorPicker::make('home_shirt_color')
                                            ->default('#000000'),
                                        ColorPicker::make('home_shorts_color')
                                            ->default('#000000'),
                                        ColorPicker::make('home_socks_color')
                                            ->default('#000000'),
                                    ]),
                            ]),
                        Tabs\Tab::make('Away')
                            ->schema([
                                Section::make()
                                    ->columns(3)
                                    ->schema([
                                        ColorPicker::make('away_shirt_color')
                                            ->default('#000000'),
                                        ColorPicker::make('away_shorts_color')
                                            ->default('#000000'),
                                        ColorPicker::make('away_socks_color')
                                            ->default('#000000'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
