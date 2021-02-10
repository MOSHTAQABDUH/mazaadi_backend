<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateOfferAPIRequest;
use App\Http\Requests\API\UpdateOfferAPIRequest;
use App\Models\Offer;
use App\Repositories\OfferRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class OfferController
 * @package App\Http\Controllers\API
 */

class OfferAPIController extends AppBaseController {
	/** @var  OfferRepository */
	private $offerRepository;

	public function __construct(OfferRepository $offerRepo) {
		$this->offerRepository = $offerRepo;
	}

	/**
	 * @param Request $request
	 * @return Response
	 *
	 * @SWG\Get(
	 *      path="/offers",
	 *      summary="Get a listing of the Offers.",
	 *      tags={"Offer"},
	 *      description="Get all Offers",
	 *      produces={"application/json"},
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  type="array",
	 *                  @SWG\Items(ref="#/definitions/Offer")
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
	public function index(Request $request) {
		$offers = $this->offerRepository->all(
			$request->except(['skip', 'limit']),
			$request->get('skip'),
			$request->get('limit')
		);

		return $this->sendResponse(
			$offers->toArray(),
			__('messages.retrieved', ['model' => __('models/offers.plural')])
		);
	}

	/**
	 * @param CreateOfferAPIRequest $request
	 * @return Response
	 *
	 * @SWG\Post(
	 *      path="/offers",
	 *      summary="Store a newly created Offer in storage",
	 *      tags={"Offer"},
	 *      description="Store Offer",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="body",
	 *          in="body",
	 *          description="Offer that should be stored",
	 *          required=false,
	 *          @SWG\Schema(ref="#/definitions/Offer")
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  ref="#/definitions/Offer"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
	public function store(CreateOfferAPIRequest $request) {
		$input = $request->all();

		$offer = $this->offerRepository->create($input);
		$response = Offer::with(['auction', 'user'])->find($offer->id);
		return $this->sendResponse(
			$response->toArray(),
			__('messages.saved', ['model' => __('models/offers.singular')])
		);
	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 * @SWG\Get(
	 *      path="/offers/{id}",
	 *      summary="Display the specified Offer",
	 *      tags={"Offer"},
	 *      description="Get Offer",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of Offer",
	 *          type="integer",
	 *          required=true,
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  ref="#/definitions/Offer"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
	public function show($id) {
		/** @var Offer $offer */
		$offer = $this->offerRepository->find($id);

		if (empty($offer)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/offers.singular')])
			);
		}

		return $this->sendResponse(
			$offer->toArray(),
			__('messages.retrieved', ['model' => __('models/offers.singular')])
		);
	}

	/**
	 * @param int $id
	 * @param UpdateOfferAPIRequest $request
	 * @return Response
	 *
	 * @SWG\Put(
	 *      path="/offers/{id}",
	 *      summary="Update the specified Offer in storage",
	 *      tags={"Offer"},
	 *      description="Update Offer",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of Offer",
	 *          type="integer",
	 *          required=true,
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="body",
	 *          in="body",
	 *          description="Offer that should be updated",
	 *          required=false,
	 *          @SWG\Schema(ref="#/definitions/Offer")
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  ref="#/definitions/Offer"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
	public function update($id, UpdateOfferAPIRequest $request) {
		$input = $request->all();

		/** @var Offer $offer */
		$offer = $this->offerRepository->find($id);

		if (empty($offer)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/offers.singular')])
			);
		}

		$offer = $this->offerRepository->update($input, $id);

		return $this->sendResponse(
			$offer->toArray(),
			__('messages.updated', ['model' => __('models/offers.singular')])
		);
	}

	/**
	 * @param int $id
	 * @return Response
	 *
	 * @SWG\Delete(
	 *      path="/offers/{id}",
	 *      summary="Remove the specified Offer from storage",
	 *      tags={"Offer"},
	 *      description="Delete Offer",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of Offer",
	 *          type="integer",
	 *          required=true,
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  type="string"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
	public function destroy($id) {
		/** @var Offer $offer */
		$offer = $this->offerRepository->find($id);

		if (empty($offer)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/offers.singular')])
			);
		}

		$offer->delete();

		return $this->sendResponse(
			$id,
			__('messages.deleted', ['model' => __('models/offers.singular')])
		);
	}
}
