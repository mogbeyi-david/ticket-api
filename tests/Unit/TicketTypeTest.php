<?php

namespace Tests\Unit;

use App\TicketType;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTypeTest extends TestCase
{
    use DatabaseTransactions;

    protected $header = [];
    protected $ticket_type;

    public  function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->header['Accept'] = 'application/json';
        $this->ticket_type = factory(TicketType::class)->create();

    }

    public function testCreateTicketType(){
        $response = $this->withHeaders([
            'Content-Type' =>  $this->header['Accept']
        ])->json('POST', 'api/v1/ticket_type', ['name' => 'Nigeria']);

        $response->assertStatus(200)->assertJsonFragment([
            'status' => 'success'
        ]);
    }

    public function testInvalidTicketTypeCreation(){
        $response = $this->withHeaders([
            'Content-Type' => $this->header['Accept']
        ])->json('POST', 'api/v1/ticket_type', ['name' => '']);

        $response->assertStatus(200)->assertJsonFragment([
            'status' => 'error',
            'data' => null
        ]);
    }

    public function testTicketTypeWithIntegers(){
        $response = $this->withHeaders([
            'Content-Type' => $this->header['Accept']
        ])->json('POST', 'api/v1/ticket_type', ['name' => 123456789]);

        $response->assertStatus(200)->assertJsonFragment([
            'status' => 'error',
            'data' => null
        ]);
    }

    public function testTicketTypeUpdate(){
        $response = $this->withHeaders([
            'Content-Type' => $this->header['Accept']
        ])->json('PUT', 'api/v1/ticket_type/'.$this->ticket_type->id, ['name' => $this->ticket_type->name]);

        $response->assertStatus(200)->assertJsonFragment([
            'status' => 'success'
        ]);
    }
}