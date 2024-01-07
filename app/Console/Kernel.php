<?php

namespace App\Console;

use App\Enums\OrderStatus;
use App\Enums\ShoppingListActive;
use App\Enums\ShoppingListStatus;
use App\Events\PurchaseSuccesful;
use App\Http\Controllers\ShoppingListController;
use App\Models\Order;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use App\Models\Status;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use function PHPUnit\Framework\isNull;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->call(function () {

            $currentTime = Carbon::now()->format('Y-m-d');

            $shopping_list = Shopping_list::all();
            //mozna with order i sprawdzac czy order jest nulem
            //$orders = Order::with('shopping_list')->get();




            foreach ($shopping_list as $item) {


                if ($item->active == ShoppingListActive::TRUE)
                {

                    $order = Order::where('SHOPPING_LISTS_id', $item->id)->first();
                    if(isset($order))
                    {
                        if ($order->status->isDelivered()) {
                            //2. gdy isDelivered to tworzymy kopie ktora bedzie jak nowa s_l none status
                            //stara s_l
                            $item->status = ShoppingListStatus::ORDER;
                            $item->active = ShoppingListActive::FALSE;

                            $item->save();

                            $this->copy($item);
                        }
                    }


                    $end_date = Carbon::parse($item->end_mod_date)->format('Y-m-d');
                    /*Jeżeli jest wszytko jak nalezy czyli status shopping_list*/
                    if ($end_date == $currentTime) {
                        if ($item->status->isNone()) {
                            //stwórz order
                            $order = new Order();
                            $order->status = OrderStatus::IN_PREPARE;
                            $order->shopping_list()->associate($item);
                            $order->save();
                            //1.jezeli zamowimy to status order czyli nie zmienny
                            $item->status = ShoppingListStatus::STOP;
                            //email z listy a nie zalogowanje osoby
                            //event(new PurchaseSuccesful($item));
                            $item->save();

                        }

                        /*Jeżeli satus o cart czyli nadal edycja to status i wyznacz nową date dostawy*/
                        if ($item->status->isCart()) {
                            //$item->status = OrderStatus::SKIPPED;
                            $item->delivery_date = $this->nextDate($item->delivery_date);
                            $item->end_mod_date = $this->endDate($item->delivery_date);
                            $item->mod_available_date = $this->mod_available_date($item->delivery_date);
                            $item->save();
                        }
                    }

                }



            }

        })->at('21:47');
            //})->daily();




    }

    public function copy(Shopping_list $shopping_list): void
    {
        $copiedShoppingList = new Shopping_list();

        $copiedShoppingList->title = $shopping_list->title;
        $copiedShoppingList->total = $shopping_list->total;
        $copiedShoppingList->mode = $shopping_list->mode;
        $copiedShoppingList->status = ShoppingListStatus::NONE;
        $copiedShoppingList->active = ShoppingListActive::TRUE;
        $copiedShoppingList->delivery_date = $this->nextDate($shopping_list->delivery_date);
        $copiedShoppingList->mod_available_date = $this->mod_available_date($shopping_list->delivery_date);
        $copiedShoppingList->end_mod_date = $this->endDate($shopping_list->delivery_date);
        $copiedShoppingList->created_at = $shopping_list->created_at;
        $copiedShoppingList->updated_at = $shopping_list->updated_at;
        $copiedShoppingList->USERS_id = $shopping_list->USERS_id;
        $copiedShoppingList->ADDRESSES_id = $shopping_list->ADDRESSES_id;



        $copiedShoppingList->save();



        foreach ($shopping_list->shopping_lists_products as $product) {
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

        /*$copiedOrder = new Order();
        $copiedOrder->status = OrderStatus::NONE;
        $copiedOrder->created_at = $order->created_at;
        $copiedOrder->updated_at = $order->updated_at;
        $copiedOrder->DELIVERIES_id = $order->DELIVERIES_id;
        $copiedOrder->PAYMENTS_id = $order->PAYMENTS_id;
        $copiedOrder->SHOPPING_LISTS_id = $copiedShoppingList->id;


        $copiedOrder->save();*/
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
