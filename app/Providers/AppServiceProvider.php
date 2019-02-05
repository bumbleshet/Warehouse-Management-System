<?php

namespace App\Providers;
use App\Product, App\Section, App\Location;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            // $event->menu->add(trans('menu.pages'));

            // $items = Product::all()->map(function (Product $student) {
            //     return [
            //         'text' => $student['first_name'],
            //         'url' => route('students.index')
            //     ];
            // });

            $items[] = [
                'text'  => 'Products',
                'icon' => 'product-hunt',
                'url' => route('products.index'),
                'label' => Product::count()
            ];

            $items[] = [
                'text'  => 'Sections',
                'icon' => 'list-alt',
                'url' => route('sections.index'),
                'label' => Section::count()
            ];

            $items[] = [
                'text'  => 'Locations',
                'icon' => 'map',
                'url' => route('locations.index'),
                'label' => Location::count()
            ];

            $event->menu->add(...$items);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
