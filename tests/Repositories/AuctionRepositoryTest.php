<?php namespace Tests\Repositories;

use App\Models\Auction;
use App\Repositories\AuctionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AuctionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AuctionRepository
     */
    protected $auctionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->auctionRepo = \App::make(AuctionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_auction()
    {
        $auction = factory(Auction::class)->make()->toArray();

        $createdAuction = $this->auctionRepo->create($auction);

        $createdAuction = $createdAuction->toArray();
        $this->assertArrayHasKey('id', $createdAuction);
        $this->assertNotNull($createdAuction['id'], 'Created Auction must have id specified');
        $this->assertNotNull(Auction::find($createdAuction['id']), 'Auction with given id must be in DB');
        $this->assertModelData($auction, $createdAuction);
    }

    /**
     * @test read
     */
    public function test_read_auction()
    {
        $auction = factory(Auction::class)->create();

        $dbAuction = $this->auctionRepo->find($auction->id);

        $dbAuction = $dbAuction->toArray();
        $this->assertModelData($auction->toArray(), $dbAuction);
    }

    /**
     * @test update
     */
    public function test_update_auction()
    {
        $auction = factory(Auction::class)->create();
        $fakeAuction = factory(Auction::class)->make()->toArray();

        $updatedAuction = $this->auctionRepo->update($fakeAuction, $auction->id);

        $this->assertModelData($fakeAuction, $updatedAuction->toArray());
        $dbAuction = $this->auctionRepo->find($auction->id);
        $this->assertModelData($fakeAuction, $dbAuction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_auction()
    {
        $auction = factory(Auction::class)->create();

        $resp = $this->auctionRepo->delete($auction->id);

        $this->assertTrue($resp);
        $this->assertNull(Auction::find($auction->id), 'Auction should not exist in DB');
    }
}
