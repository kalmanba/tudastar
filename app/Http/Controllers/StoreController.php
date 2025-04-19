<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use \Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all stores from the database
        $stores = Store::all();

        // Create a modified collection where the 'images' field shows only the first image
        $modifiedStores = $stores->map(function ($store) {
            // Create a copy of the store as an array
            $storeArray = $store->toArray();
            
            // Replace the images field with just the first image URL
            if (isset($storeArray['images']['images']) && is_array($storeArray['images']['images']) && !empty($storeArray['images']['images'])) {
                // If the structure is {'images': [...]}
                $storeArray['images'] = $storeArray['images']['images'][0];
            } elseif (is_array($storeArray['images']) && !empty($storeArray['images'])) {
                // If the structure is just an array of images
                $storeArray['images'] = $storeArray['images'][0];
            } else {
                // Fallback if no images
                $storeArray['images'] = null;
            }
            
            return $storeArray;
        });


        return view('store.main')->with(['modifiedStores' => $modifiedStores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        if ($store->status == 0) {
            $status = "Előrendelhető";
            $status_Colour = "text-bg-danger";
        } elseif ($store->status == 1) {
            $status = "Beszállítás alatt";
            $status_Colour = "text-bg-warning";
        } elseif ($store->status == 2) {
            $status = "Raktáron";
            $status_Colour = "text-bg-success";
        } else {
            $status = "Státusz N/A";
            $status_Colour = "text-bg-dark";
        }
        if ($store->desc != NULL) {
            $store->desc = Str::markdown($store->desc);
        }

        return view('store.item')->with(['store' => $store, 'status' => $status, 'status_Colour' => $status_Colour]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
