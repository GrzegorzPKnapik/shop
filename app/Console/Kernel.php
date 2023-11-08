<?php

namespace App\Console;

use App\Models\Order;
use App\Models\Shopping_list;
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




            //if($shopping_lists->mode)




            foreach ($orders as $item) {

                if ($item->status == 'delivered') {
//                    foreach ($item->shopping_list as $shoppingListItem) {
//                        $shoppingListItem->status = 'resume';
//                    }

                    //powinno utworzyć nowe zamówinie z tym orderem  albo z kopią od razu

                    $item->shopping_list->status = 'resume';
                }


                if($item->shopping_list->active == true)
                {
                    //powinno utworzyć nowe zamówinie z tym orderem  albo z kopią od razu
                    //tworzy nowe zamówinie i s_l kopia wszystko
                    //moze wykonać to co wczytaj edycje ale sie nei da bo jest w order i wtedy tworzy nowe
                    // {{ __('Załaduj listę zakupów do dalszej edycji') }}


                }



                $end_date = Carbon::parse($item->shopping_list->end_mod_date)->format('Y-m-d');
                if ($end_date == $currentTime) {

                    //jeżeli jest wszytko jak nalezy czyli status shopping_list
                    //to zmiana statsusu na in_prepare
                    if ($item->shopping_list->status == 'shopping_list') {
                        $item->status = 'in_prepare';
                        $item->shopping_list->status = 'stop';
                    }

                    //jeżeli satus o cart czyli nadal edycja to status i wyznacz nową date dostawy
                    if ($item->shopping_list->status == 'cart' && $item->shopping_list->mode == 'cyclical') {
                        $item->status = 'skipped';
                        $item->shopping_list->delivery_date = $this->nextDate($item->shopping_list->delivery_date);
                        $item->shopping_list->end_mod_date = $this->endDate($item->shopping_list->delivery_date);
                        $item->shopping_list->mod_available_date = $this->mod_available_date($item->shopping_list->delivery_date);
                    }
                }
                $item->save();
                $item->shopping_list->save();

            }






                //jeżeli delivered to resume przyznaj
                //uwtórz nowe zamówinie i nową listezakupów
                //

                //przyznaie resume
//                if($item->status == 'delivered'){
//
//
//                    $item->set_delivery_date = $this->nextDate($item->set_delivery_date);
//                    $item->shopping_list->end_mode_date = $this->endDate($item->set_delivery_date);
//                    $item->shopping_list->mod_available_date = $this->mod_available_date($item->set_delivery_date);
//
//                    $item->status = '';
//                }
//
//
//
//
//
//                //jeżeli jest dostarczona wyznacz następną datę dostawy cyklicznej
//                if($item->status == 'delivered'){
//                    $item->set_delivery_date = $this->nextDate($item->set_delivery_date);
//                    $item->shopping_list->end_mode_date = $this->endDate($item->set_delivery_date);
//                    $item->shopping_list->mod_available_date = $this->mod_available_date($item->set_delivery_date);
//
//                    $item->status = '';
//                }
//
//                $end_date = Carbon::parse($item->end_date)->format('Y-m-d');
//                if ($end_date == $currentTime){
//
//                    //jeżeli jest wszytko jak nalezy czyli status shopping_list
//                    //to zmiana statsusu na in_prepare
//                    if ($item->shopping_list->status == 'shopping_list') {
//                        $item->status = 'in_prepare';
//                    }
//
//                    //jeżeli satus o cart czyli nadal edycja to status i wyznacz nową date dostawy
//                    if ($item->shopping_list->status == 'cart' && $item->shopping_list->mode=='cyclical') {
//                        $item->status = 'skipped';
//                        $item->set_delivery_date = $this->nextDate($item->set_delivery_date);
//                        $item->shopping_list->end_mode_date = $this->endDate($item->set_delivery_date);
//                        $item->shopping_list->mod_available_date = $this->mod_available_date($item->set_delivery_date);
//                    }
//                }
//                $item->save();
//            }


        })->at('16:43');
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

    private function shopping_list_no_active($date)
    {

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
