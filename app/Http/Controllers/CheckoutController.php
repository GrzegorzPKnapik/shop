<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Order;
use App\Models\Shopping_list;
use App\Models\Shopping_lists_product;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\ValueObjects\Cart;
use function PHPUnit\Framework\isNull;

class CheckoutController extends Controller
{


    public function index()
    {
        $user = Auth::user();

        $addresses = Address::with('user')->where('status', null)->whereHas('user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->get();

        $deliveryDate = $this->deliveryDate();

        $collectionDates = $this->date();

        return view('checkout.index',['addresses'=>$addresses, 'collectionDates'=>$collectionDates, 'deliveryDate'=>$deliveryDate]);
    }


    public function date()
    {
        $collectionDates = new Collection();

        $daysOfWeek = [
            1 => 'poniedziałek',
            2 => 'wtorek',
            3 => 'środa',
            4 => 'czwartek',
            5 => 'piątek',
            6 => 'sobota',

        ];

        //niedziela to pon za tydz, wtorek ten, sroda ta...

       // 2c
       // 1d


        $currentDay = date('N');
        for ($i = 1; $i <= 6; $i++) {
            $dayOfWeek = $i;
            if ($currentDay > $dayOfWeek) {
                $daysToAdd = 7 - $currentDay + $dayOfWeek;
            }
            else {
                $daysToAdd = $dayOfWeek - $currentDay;
            }

            $date = date('Y-m-d', strtotime("+$daysToAdd days"));
            $collectionDates->push(['id' => $i, 'name' => $daysOfWeek[$i], 'date' => $date]);
        }
        return $collectionDates;
    }

    private function deliveryDate()
    {
        $deliveryDate = new Collection();

        $daysOfWeek = [
            1 => 'poniedziałek',
            2 => 'wtorek',
            3 => 'środa',
            4 => 'czwartek',
            5 => 'piątek',
            6 => 'sobota',
        ];

        $time = 2; // przykładowa liczba dni do dodania
        $daysToAdd = $time;
        $currentDay = date('N');

        if ($currentDay + $time == 7) {
            $daysToAdd += 1;
        }
        $date = date('Y-m-d', strtotime("+$daysToAdd days"));
        $dayOfWeekNumber = date('N', strtotime($date));
        $deliveryDate->push(['name' => $daysOfWeek[$dayOfWeekNumber], 'date' => $date]);


        return $deliveryDate;
    }





}
