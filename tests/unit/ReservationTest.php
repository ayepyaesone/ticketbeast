<?php

use App\Concert;
use App\Reservation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ReservationTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	public function calculating_the_total_cost()
	{
	    $concert = create(Concert::class, ['ticket_price' => 1200])->addTickets(3);

	    $tickets = $concert->findTickets(3);

	    $reservation = new Reservation($tickets);

	    $this->assertEquals(3600, $reservation->totalCost());
	}
}