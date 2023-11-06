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



            foreach ($orders as $item) {

                //jeżeli jest dostarczona wyznacz następną datę dostawy cyklicznej
                if($item->status == 'delivered'){
                    $item->set_delivery_date = $this->nextDate($item->set_delivery_date);
                    $item->shopping_list->end_mode_date = $this->endDate($item->set_delivery_date);
                    $item->shopping_list->mod_available_date = $this->mod_available_date($item->set_delivery_date);

                    $item->status = '';
                }

                $end_date = Carbon::parse($item->end_date)->format('Y-m-d');
                if ($end_date == $currentTime){

                    //jeżeli jest wszytko jak nalezy czyli status shopping_list
                    //to zmiana statsusu na in_prepare
                    if ($item->shopping_list->status == 'shopping_list') {
                        $item->status = 'in_prepare';
                    }

                    //jeżeli satus o cart czyli nadal edycja to status i wyznacz nową date dostawy
                    if ($item->shopping_list->status == 'cart' && $item->shopping_list->mode=='cyclical') {
                        $item->status = 'skipped';
                        $item->set_delivery_date = $this->nextDate($item->set_delivery_date);
                        $item->shopping_list->end_mode_date = $this->endDate($item->set_delivery_date);
                        $item->shopping_list->mod_available_date = $this->mod_available_date($item->set_delivery_date);
                    }
                }
                $item->save();
            }


        })->daily();
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
