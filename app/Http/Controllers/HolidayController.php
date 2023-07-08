<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Holiday;

class HolidayController extends Controller
{
    /**
     * gets all the holidays on the rest api
     * @param $request
     */
    public function holidays(Request $request)
    {

        $this->validate($request, [
            'year' => 'required'
        ]);

        $holiday = new Holiday;
        // get the year from the user input
        $holiday->year = $request->input('year');
        $url = 'https://kayaposoft.com/enrico/json/v2.0/?action=getHolidaysForYear&year=' . $holiday->year . '&country=est&holidayType=public_holiday';

        $response = Http::retry(3, 100)->get($url);
        return $response->json();

    }
}
