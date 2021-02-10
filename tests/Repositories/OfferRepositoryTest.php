<?php namespace Tests\Repositories;

use App\Models\Offer;
use App\Repositories\OfferRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OfferRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OfferRepository
     */
    protected $offerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->offerRepo = \App::make(OfferRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_offer()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $createdOffer = $this->offerRepo->create($offer);

        $createdOffer = $createdOffer->toArray();
        $this->assertArrayHasKey('id', $createdOffer);
        $this->assertNotNull($createdOffer['id'], 'Created Offer must have id specified');
        $this->assertNotNull(Offer::find($createdOffer['id']), 'Offer with given id must be in DB');
        $this->assertModelData($offer, $createdOffer);
    }

    /**
     * @test read
     */
    public function test_read_offer()
    {
        $offer = factory(Offer::class)->create();

        $dbOffer = $this->offerRepo->find($offer->id);

        $dbOffer = $dbOffer->toArray();
        $this->assertModelData($offer->toArray(), $dbOffer);
    }

    /**
     * @test update
     */
    public function test_update_offer()
    {
        $offer = factory(Offer::class)->create();
        $fakeOffer = factory(Offer::class)->make()->toArray();

        $updatedOffer = $this->offerRepo->update($fakeOffer, $offer->id);

        $this->assertModelData($fakeOffer, $updatedOffer->toArray());
        $dbOffer = $this->offerRepo->find($offer->id);
        $this->assertModelData($fakeOffer, $dbOffer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_offer()
    {
        $offer = factory(Offer::class)->create();

        $resp = $this->offerRepo->delete($offer->id);

        $this->assertTrue($resp);
        $this->assertNull(Offer::find($offer->id), 'Offer should not exist in DB');
    }
}
