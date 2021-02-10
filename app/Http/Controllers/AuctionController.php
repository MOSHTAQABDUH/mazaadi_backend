<?php

namespace App\Http\Controllers;

use App\DataTables\AuctionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAuctionRequest;
use App\Http\Requests\UpdateAuctionRequest;
use App\Repositories\AuctionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class AuctionController extends AppBaseController
{
    /** @var  AuctionRepository */
    private $auctionRepository;

    public function __construct(AuctionRepository $auctionRepo)
    {
        $this->auctionRepository = $auctionRepo;
    }

    /**
     * Display a listing of the Auction.
     *
     * @param AuctionDataTable $auctionDataTable
     * @return Response
     */
    public function index(AuctionDataTable $auctionDataTable)
    {
        return $auctionDataTable->render('admin.auctions.index');
    }

    /**
     * Show the form for creating a new Auction.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.auctions.create');
    }

    /**
     * Store a newly created Auction in storage.
     *
     * @param CreateAuctionRequest $request
     *
     * @return Response
     */
    public function store(CreateAuctionRequest $request)
    {
        $input = $request->all();

        $auction = $this->auctionRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/auctions.singular')]));

        return redirect(route('admin.auctions.index'));
    }

    /**
     * Display the specified Auction.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $auction = $this->auctionRepository->find($id);

        if (empty($auction)) {
            Flash::error(__('models/auctions.singular').' '.__('messages.not_found'));

            return redirect(route('admin.auctions.index'));
        }

        return view('admin.auctions.show')->with('auction', $auction);
    }

    /**
     * Show the form for editing the specified Auction.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $auction = $this->auctionRepository->find($id);

        if (empty($auction)) {
            Flash::error(__('messages.not_found', ['model' => __('models/auctions.singular')]));

            return redirect(route('admin.auctions.index'));
        }

        return view('admin.auctions.edit')->with('auction', $auction);
    }

    /**
     * Update the specified Auction in storage.
     *
     * @param  int              $id
     * @param UpdateAuctionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAuctionRequest $request)
    {
        $auction = $this->auctionRepository->find($id);

        if (empty($auction)) {
            Flash::error(__('messages.not_found', ['model' => __('models/auctions.singular')]));

            return redirect(route('admin.auctions.index'));
        }

        $auction = $this->auctionRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/auctions.singular')]));

        return redirect(route('admin.auctions.index'));
    }

    /**
     * Remove the specified Auction from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $auction = $this->auctionRepository->find($id);

        if (empty($auction)) {
            Flash::error(__('messages.not_found', ['model' => __('models/auctions.singular')]));

            return redirect(route('admin.auctions.index'));
        }

        $this->auctionRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/auctions.singular')]));

        return redirect(route('admin.auctions.index'));
    }
}
