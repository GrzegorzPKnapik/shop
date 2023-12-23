<?php

namespace App\Http\Controllers;


use App\Enums\AddressStatus;
use App\Enums\ShoppingListStatus;
use App\Http\Requests\StoreAddressRequest;
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
use Illuminate\View\View;
use function PHPUnit\Framework\isNull;

class CheckoutController extends Controller
{


    public function index()
    {
        $user = Auth::user();


        //przypisanie adresu wybranego domyslnie
        $cart = \Illuminate\Support\Facades\View::getShared('cart');
        $shopping_list = Shopping_list::where('id', $cart['cart']->id)->first();






        if(!isset($shopping_list->address->id))
        {
            $shoppingListController = new ShoppingListController();
            $shoppingListController->firstAssignAddress($shopping_list);
        }
        //end




        $addresses = Address::with('user')->where('status', AddressStatus::NONE)->whereHas('user', function ($query) use ($user){
            $query->where('id', $user->id);
        })->orderByDesc('selected')->get();


        $sl = Shopping_list::where('id', $cart['cart']->id)->first();

        $deliveryDate = $this->deliveryDate();

        $collectionDates = $this->date();



        return view('checkout.index',['sl'=>$sl,'addresses'=>$addresses, 'collectionDates'=>$collectionDates, 'deliveryDate'=>$deliveryDate]);
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
            7 => 'n',

        ];


        //pon działa wszystko 100%
        //wt działa
        //2
        //nastepny za 2 dni

        //7




        $daysToAdd = 2;
        $currentDay = date('N');
        for ($i = 1; $i <= 6; $i++) {
            $dayOfWeek = $i;
            //1>1 nie prawda ale 1==1
            //1,2 ; 1<2
            //7,1 ;
            //działa od pon do sb
            if($currentDay==7 && $dayOfWeek==1)
            {
                $daysToAdd = 8;

            }else
            if ($currentDay > $dayOfWeek || $currentDay == $dayOfWeek) {
                $daysToAdd = 7 - $currentDay + $dayOfWeek;
            }else
            {
                //if do przeszłych i 2 dni odstępu nie dziąła dla 7
                $test = $dayOfWeek - $currentDay;
                if($test<2)
                $daysToAdd = 8;
                else
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
