<?php

namespace App\Http\Controllers;

use App\DataTables\OfferDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Repositories\OfferRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OfferController extends AppBaseController
{
    /** @var  OfferRepository */
    private $offerRepository;

    public function __construct(OfferRepository $offerRepo)
    {
        $this->offerRepository = $offerRepo;
    }

    /**
     * Display a listing of the Offer.
     *
     * @param OfferDataTable $offerDataTable
     * @return Response
     */
    public function index(OfferDataTable $offerDataTable)
    {
        return $offerDataTable->render('admin.offers.index');
    }

    /**
     * Show the form for creating a new Offer.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.offers.create');
    }

    /**
     * Store a newly created Offer in storage.
     *
     * @param CreateOfferRequest $request
     *
     * @return Response
     */
    public function store(CreateOfferRequest $request)
    {
        $input = $request->all();

        $offer = $this->offerRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/offers.singular')]));

        return redirect(route('admin.offers.index'));
    }

    /**
     * Display the specified Offer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error(__('models/offers.singular').' '.__('messages.not_found'));

            return redirect(route('admin.offers.index'));
        }

        return view('admin.offers.show')->with('offer', $offer);
    }

    /**
     * Show the form for editing the specified Offer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offers.singular')]));

            return redirect(route('admin.offers.index'));
        }

        return view('admin.offers.edit')->with('offer', $offer);
    }

    /**
     * Update the specified Offer in storage.
     *
     * @param  int              $id
     * @param UpdateOfferRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfferRequest $request)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offers.singular')]));

            return redirect(route('admin.offers.index'));
        }

        $offer = $this->offerRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/offers.singular')]));

        return redirect(route('admin.offers.index'));
    }

    /**
     * Remove the specified Offer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offers.singular')]));

            return redirect(route('admin.offers.index'));
        }

        $this->offerRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/offers.singular')]));

        return redirect(route('admin.offers.index'));
    }
}
