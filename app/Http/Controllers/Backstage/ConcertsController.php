<?php

namespace App\Http\Controllers\Backstage;

use App\Concert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConcertsController extends Controller
{
    public function create()
    {
    	return view('backstage.concerts.create');
    }

    public function store()
    {
    	$this->validate(request(), [
    		'title' 			=> 'required',
    		'date'				=> 'required|date',
    		'time'				=> 'required|date_format:g:ia',
    		'venue'				=> 'required',
    		'city'				=> 'required',
    		'state'				=> 'required|max:2',
    		'zip'				=> 'required',
    		'ticket_price' 		=> 'required|numeric|min:5',
    		'ticket_quantity'	=> 'required|numeric|min:1'
		]);

    	$concert = Concert::create([
    		'title' 					=> request('title'),
    		'subtitle' 					=> request('subtitle'),
    		'date'						=> Carbon::parse(vsprintf('%s %s', [request('date'), request('time')])),
    		'ticket_price'				=> request('ticket_price') * 100,
    		'venue'						=> request('venue'),
    		'venue_address' 			=> request('venue_address'),
    		'city' 						=> request('city'),
    		'state' 					=> request('state'),
    		'zip'	 					=> request('zip'),
    		'additional_information'	=> request('additional_information'),
		])->addTickets(request('ticket_quantity'));

    	return redirect()->route('concerts.show', $concert);
    }
}
