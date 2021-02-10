<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateAuctionAPIRequest;
use App\Http\Requests\API\UpdateAuctionAPIRequest;
use App\Http\Resources\AuctionResource;
use App\Models\Auction;
use App\Repositories\AuctionRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use JWTAuth;
use Response;

/**
 * Class AuctionController
 * @package App\Http\Controllers\API
 */

class AuctionAPIController extends AppBaseController {
	/** @var  AuctionRepository */
	private $auctionRepository;

	public function __construct(AuctionRepository $auctionRepo) {
		$this->auctionRepository = $auctionRepo;
	}

	/**
	 * Display a listing of the Auction.
	 * GET|HEAD /auctions
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function index(Request $request) {
	    if(request('city_id')){
	        $auctions = Auction::where('status', 'on')->where('city_id',request('city_id'))->with(['images', 'category', 'user', 'city', 'country'])->get()->toArray();
	    }else{
	        $auctions = Auction::where('status', 'on')->with(['images', 'category', 'user', 'city', 'country'])->get()->toArray();
	    }
		

		return $this->sendResponse(
			$this->arrayPaginator($auctions, $request),
			__('messages.retrieved', ['model' => __('models/auctions.plural')])
		);
	}

	/**
	 * Display a listing of the Auction.
	 * GET|HEAD /auctions
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function AuctionComing(Request $request) {
	    
	    if(request('city_id')){
	        $auctions = Auction::where('status', 'off')->where('city_id',request('city_id'))->with(['images', 'category', 'user', 'city', 'country'])->get()->toArray();
	    }else{
	        $auctions = Auction::where('status', 'off')->with(['images', 'category', 'user', 'city', 'country'])->get()->toArray();
	    }
	    
		return $this->sendResponse(
			$this->arrayPaginator($auctions, $request),
			__('messages.retrieved', ['model' => __('models/auctions.plural')])
		);
	}

	/**
	 * Store a newly created Auction in storage.
	 * POST /auctions
	 *
	 * @param CreateAuctionAPIRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateAuctionAPIRequest $request) {
		$input = $request->all();

		$auction = $this->auctionRepository->create($input);
		$response = new AuctionResource($this->auctionRepository->find($auction->id));
		return $this->sendResponse(
			new AuctionResource($response),
			__('messages.saved', ['model' => __('models/auctions.singular')])
		);
	}

	/**
	 * Display the specified Auction.
	 * GET|HEAD /auctions/{id}
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function show($id) {
		/** @var Auction $auction */
		$auction = $this->auctionRepository->find($id);

		if (empty($auction)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/auctions.singular')])
			);
		}

		return $this->sendResponse(
			new AuctionResource($auction),
			__('messages.retrieved', ['model' => __('models/auctions.singular')])
		);
	}

	/**
	 * Update the specified Auction in storage.
	 * PUT/PATCH /auctions/{id}
	 *
	 * @param int $id
	 * @param UpdateAuctionAPIRequest $request
	 *
	 * @return Response
	 */
	public function update($id) {
		$input = collect(request()->all())->filter()->all();

		/** @var Auction $auction */
		$auction = $this->auctionRepository->find($id);

		if (empty($auction)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/auctions.singular')])
			);
		}

		$auction = new AuctionResource($this->auctionRepository->update($input, $id));

		return $this->sendResponse(
			$auction,
			__('messages.updated', ['model' => __('models/auctions.singular')])
		);
	}

	public function Open($id) {
		try {
			if (!$user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return $this->sendError(['token_expired', $e->getStatusCode()]);

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
			return $this->sendError(['token_invalid', $e->getStatusCode()]);

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
			return $this->sendError(['token_absent', $e->getStatusCode()]);
		}
		/** @var Auction $auction */
		$auction = $this->auctionRepository->find($id);

		if (empty($auction)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/auctions.singular')])
			);
		}

		if ($user->type != 'moderator' || $user->type != 'admin') {
			return $this->sendError(
				__('messages.havnt_credentials')
			);
		}

		$auction = new AuctionResource($this->auctionRepository->update(['status' => 'on'], $id));

		return $this->sendResponse(
			$auction,
			__('messages.updated', ['model' => __('models/auctions.singular')])
		);
	}

	public function Close($id) {
		try {
			if (!$user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}

		} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

			return $this->sendError(['token_expired', $e->getStatusCode()]);

		} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
			return $this->sendError(['token_invalid', $e->getStatusCode()]);

		} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
			return $this->sendError(['token_absent', $e->getStatusCode()]);
		}
		/** @var Auction $auction */
		$auction = $this->auctionRepository->find($id);

		if (empty($auction)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/auctions.singular')])
			);
		}

		if ($user->type != 'moderator' || $user->type != 'admin') {
			return $this->sendError(
				__('messages.havnt_credentials')
			);
		}

		$auction = new AuctionResource($this->auctionRepository->update(['status' => 'off'], $id));

		return $this->sendResponse(
			$auction,
			__('messages.updated', ['model' => __('models/auctions.singular')])
		);
	}

	/**
	 * Remove the specified Auction from storage.
	 * DELETE /auctions/{id}
	 *
	 * @param int $id
	 *
	 * @throws \Exception
	 *
	 * @return Response
	 */
	public function destroy($id) {
		/** @var Auction $auction */
		$auction = $this->auctionRepository->find($id);

		if (empty($auction)) {
			return $this->sendError(
				__('messages.not_found', ['model' => __('models/auctions.singular')])
			);
		}

		$auction->delete();

		return $this->sendResponse(
			$id,
			__('messages.deleted', ['model' => __('models/auctions.singular')])
		);
	}

	public function arrayPaginator($items, $request) {
		$currentPage = LengthAwarePaginator::resolveCurrentPage();
		$perPage = 10;

		$items = array_reverse(array_sort($items, function ($value) {
			return $value['created_at'];
		}));
		$currentItems = array_slice($items, $perPage * ($currentPage - 1), $perPage);

		$paginator = new LengthAwarePaginator($currentItems, count($items), $perPage, $currentPage, ['path' => $request->url(), 'query' => $request->query()]);
		return $results = $paginator->appends('filter', request('filter'));
	}
}
