<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Offer;

class OfferApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_offer()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/offers', $offer
        );

        $this->assertApiResponse($offer);
    }

    /**
     * @test
     */
    public function test_read_offer()
    {
        $offer = factory(Offer::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/offers/'.$offer->id
        );

        $this->assertApiResponse($offer->toArray());
    }

    /**
     * @test
     */
    public function test_update_offer()
    {
        $offer = factory(Offer::class)->create();
        $editedOffer = factory(Offer::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/offers/'.$offer->id,
            $editedOffer
        );

        $this->assertApiResponse($editedOffer);
    }

    /**
     * @test
     */
    public function test_delete_offer()
    {
        $offer = factory(Offer::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/offers/'.$offer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/offers/'.$offer->id
        );

        $this->response->assertStatus(404);
    }
}
