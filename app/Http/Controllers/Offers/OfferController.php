<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    use OfferTraits;

    public function create()
    {
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {
        $photo = $this->saveImage($request->file('photo'), 'images/offers');
        // Insert into the database
        Offer::create([
            'photo' => isset($photo) ? $photo : null,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
            'price' => $request->price,
        ]);



        return redirect()->back()->with(['success' => __('messages.Offer added succcessfully')])->withInput();
    }


    public function getall()
    {
        $offers = [];
        app()->getLocale();
        $offers = Offer::select(
            'id',
            'photo',
            'name_' . app()->getLocale() . ' as name',
            'details_' . app()->getLocale() . ' as details',
            'price'
        )->get();
        return view('offers.all')->with('offers', $offers);
    }

    public function edit($offer_id)
    {
        $offer = Offer::all()->where('id', $offer_id)->first();
        return
            $offer ? view('offers.edit', compact('offer'))
            : redirect()->back()->with(['error' => 'Offer not found']);
    }

    public function update(OfferRequest $request, $offer_id)
    {
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->photo = $this->saveImage($request->file('photo'), 'images/offers');
        $offer->update($request->all());
        return redirect()->back()->with(['success' => 'Offer udated successfully']);
    }

    public function delete(Request $request, $offer_id)
    {
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();
        return redirect()->back()->with(['success' => __('messages.offer deleted successfully')]);
    }

    ######################## Ajax function ##########################
    public function ajaxCreate()
    {
        return view('ajax_offers.create');
    }

    public function ajaxStore(OfferRequest $request)
    {
        $photo = $this->saveImage($request->file('photo'), 'images/offers');
        // Insert into the database in table offers
        $offer = Offer::create([
            'photo' => isset($photo) ? $photo : null,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
            'price' => $request->price,
        ]);

        if ($offer)
            return response()->json([
                'status' => true,
                'msg' => 'offer is added successfully'
            ]);
        else
            return response()->json([
                'status' => false,
                'msg' => 'failed to add offer'
            ]);
    }

    public function all()
    {
        app()->getLocale();
        $offers = Offer::select(
            'id',
            'photo',
            'name_' . app()->getLocale() . ' as name',
            'details_' . app()->getLocale() . ' as details',
            'price'
        )->get();
        return view('ajax_offers.all', compact('offers'));
    }

    public function ajaxDelete(Request $request)
    {
        $offer = Offer::find($request->id);
        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();
        return response()->json([
            'status' => true,
            'msg' => 'offer is deleted successfully',
            'id' => $request->id,
        ]);
    }

    public function ajaxEdit($offer_id)
    {
        $offer = Offer::all()->where('id', $offer_id)->first();
        return
            $offer ? view('ajax_offers.edit', compact('offer'))
            : response()->json([
                'status' => true,
                'msg' => 'Offer is not Exist',
            ]);
    }

    public function ajaxUpdate(OfferRequest $request, $offer_id)
    {
        $offer = Offer::find($request->id);
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'Offer is not Exist',
            ]);

        if ($request->hasFile('photo')) {
            // Delete the previous photo if it exists
            if ($offer->photo) {
                Storage::delete($offer->photo);
            }
        }
        $offer->photo = $this->saveImage($request->file('photo'), 'images/offers');
        $offer->update($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'Offer updated successfully',
        ]);
    }
    ######################## end of Ajax function ##########################
}
