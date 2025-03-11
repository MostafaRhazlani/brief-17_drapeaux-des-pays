<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        return response()->json(['status' => 'success', 'countries' => $countries], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_name' => 'required|string',
            'capital' => 'required|string',
            'population' => 'required|numeric',
            'region' => 'required|string',
            'currency' => 'required|string',
            'language' => 'required|string',
            'flag' => 'required'
        ]);
        try {

            $country = Country::create([
                'country_name' => $validated['country_name'],
                'capital' => $validated['capital'],
                'population' => $validated['population'],
                'region' => $validated['region'],
                'currency' => $validated['currency'],
                'language' => $validated['language'],
                'flag' => $validated['flag'],
            ]);

            return response()->json(['status' => 'success', 'country' => $country], 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }
}
