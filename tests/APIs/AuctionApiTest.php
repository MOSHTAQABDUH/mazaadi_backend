<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Auction;

class AuctionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_auction()
    {
        $auction = factory(Auction::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/auctions', $auction
        );

        $this->assertApiResponse($auction);
    }

    /**
     * @test
     */
    public function test_read_auction()
    {
        $auction = factory(Auction::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/auctions/'.$auction->id
        );

        $this->assertApiResponse($auction->toArray());
    }

    /**
     * @test
     */
    public function test_update_auction()
    {
        $auction = factory(Auction::class)->create();
        $editedAuction = factory(Auction::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/auctions/'.$auction->id,
            $editedAuction
        );

        $this->assertApiResponse($editedAuction);
    }

    /**
     * @test
     */
    public function test_delete_auction()
    {
        $auction = factory(Auction::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/auctions/'.$auction->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/auctions/'.$auction->id
        );

        $this->response->assertStatus(404);
    }
}
