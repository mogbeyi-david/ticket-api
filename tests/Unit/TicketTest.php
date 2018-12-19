<?php

namespace Tests\Unit;

use App\Ticket;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{
    use DatabaseTransactions;

    protected $header = [];
    protected $ticket;

    public  function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->header['Accept'] = 'application/json';
        $this->ticket = factory(Ticket::class)->create();

    }

    public function testCreateTicket(){
        $response = $this->withHeaders([
            'Content-Type' =>  $this->header['Accept']
        ])->json('POST', 'api/v1/ticket', ['code' => 'abc123', 'ticket_type_id' => 1]);

        $response->assertStatus(200)->assertJsonFragment([
            'status' => 'success'
        ]);
    }

    public function testFetchAllicket(){
        $response = $this->withHeaders([
            'Content-Type' =>  $this->header['Accept']
        ])->json('GET', 'api/v1/ticket');

        $response->assertStatus(200)->assertJsonFragment([
            'status' => 'success'
        ]);
    }

    public function testTicketUpdate(){
        $response = $this->withHeaders([
            'Content-Type' => $this->header['Accept']
        ])->json('PUT', 'api/v1/ticket/'.$this->ticket->id, ['code' => $this->ticket->name, 'ticket_type_id' => $this->ticket->ticket_type_id]);

        $response->assertStatus(200)->assertJsonFragment([
            'status' => 'error',
            'data' => null
        ]);
    }
}
