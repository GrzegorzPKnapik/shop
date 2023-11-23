<?php

namespace App\Console;

use App\Http\Controllers\ShoppingListController;
use App\Models\Order;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use App\Models\Status;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {

            $currentTime = Carbon::now()->format('Y-m-d');
            $orders = Order::with('shopping_list')->get();

            foreach ($orders as $item) {


                if($item->shopping_list->active && $item->status == Status::DELIVERED)
                {
                    //stara s_l
                    $item->shopping_list->status = Shopping_list::RESUME;
                    $item->shopping_list->active = false;
                    $item->shopping_list->save();

                    $this->copy($item->shopping_list);
                }

                $end_date = Carbon::parse($item->shopping_list->end_mod_date)->format('Y-m-d');
                if ($end_date == $currentTime){


                    //jeżeli jest wszytko jak nalezy czyli status shopping_list
                    if ($item->shopping_list->active && $item->shopping_list->status == null && $item->status == null) {
                        $item->status()->associate(Status::where('name',  Status::IN_PREPARE)->first())->save();
                        $item->shopping_list->status = Shopping_list::STOP;
                    }

                    //jeżeli satus o cart czyli nadal edycja to status i wyznacz nową date dostawy
                    if ($item->shopping_list->status == 'cart' && $item->shopping_list->active == true) {
                        $item->status()->associate(Status::where('name',  Status::SKIPPED)->first())->save();
                        $item->shopping_list->delivery_date = $this->nextDate($item->shopping_list->delivery_date);
                        $item->shopping_list->end_mode_date = $this->endDate($item->shopping_list->delivery_date);
                        $item->shopping_list->mod_available_date = $this->mod_available_date($item->shopping_list->delivery_date);
                    }
                }


                $item->shopping_list->save();
                $item->save();

            }


        })->at('22:14');



    }

    public function copy(Shopping_list $shopping_list): void
    {


        $order = Order::where('SHOPPING_LISTS_id', $shopping_list->id)->first();


        $copiedShoppingList = new Shopping_list();

        $copiedShoppingList->title = $shopping_list->title;
        $copiedShoppingList->total = $shopping_list->total;
        $copiedShoppingList->mode = $shopping_list->mode;
        $copiedShoppingList->status = null;
        $copiedShoppingList->active = true;
        $copiedShoppingList->delivery_date = $this->nextDate($shopping_list->delivery_date);
        $copiedShoppingList->mod_available_date = $this->mod_available_date($shopping_list->delivery_date);
        $copiedShoppingList->end_mod_date = $this->endDate($shopping_list->delivery_date);
        $copiedShoppingList->created_at = $shopping_list->created_at;
        $copiedShoppingList->updated_at = $shopping_list->updated_at;
        $copiedShoppingList->USERS_id = $shopping_list->USERS_id;

        $copiedShoppingList->save();


        //kopia asocjacyjnej
        $shopping_lists_product = Shopping_lists_product::where('SHOPPING_LISTS_id', $shopping_list->id)->get();


        foreach ($shopping_lists_product as $product) {
            $copiedShoppingListsProduct = new Shopping_lists_product();
            $copiedShoppingListsProduct->sub_total = $product->sub_total;
            $copiedShoppingListsProduct->quantity = $product->quantity;
            $copiedShoppingListsProduct->created_at = $product->created_at;
            $copiedShoppingListsProduct->updated_at = $product->updated_at;
            $copiedShoppingListsProduct->PRODUCTS_id = $product->PRODUCTS_id;
            $copiedShoppingListsProduct->SHOPPING_LISTS_id = $copiedShoppingList->id;
            $copiedShoppingListsProduct->save();
        }

        //orde też musze skopiować tworze order z tymi samymi danymi ale zminia sie id shopping_list na skopiowaną

        $copiedOrder = new Order();
        $copiedOrder->set_delivery_date = $shopping_list->set_delivery_date;
        $copiedOrder->create_date = $order->create_date;
        $copiedOrder->created_at = $order->created_at;
        $copiedOrder->updated_at = $order->updated_at;
        $copiedOrder->DELIVERIES_id = $order->DELIVERIES_id;
        $copiedOrder->PAYMENTS_id = $order->PAYMENTS_id;
        $copiedOrder->ADDRESSES_id = $order->ADDRESSES_id;
        $copiedOrder->SHOPPING_LISTS_id = $copiedShoppingList->id;


        $copiedOrder->save();
    }



    public function nextDate($date)
    {
        $daysToAdd = 7;
        $date = date('Y-m-d', strtotime($date . "+$daysToAdd days"));

        return $date;
    }

    private function endDate($date)
    {
        $end_date = date('Y-m-d', strtotime($date . ' -1 day'));
        return $end_date;
    }

    private function mod_available_date($date)
    {
        $mod_date = date('Y-m-d', strtotime($date . ' -2 day'));
        return $mod_date;
    }


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
