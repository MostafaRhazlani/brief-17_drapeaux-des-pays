<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="My API Documentation",
 *      description="Swagger API documentation for my Laravel project",
 *      @OA\Contact(
 *          email="contact@example.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 */

class CountryController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/countries",
     *      summary="Get all countries",
     *      tags={"Countries"},
     *      @OA\Response(
     *          response=200,
     *          description = "list of countries",
     *          @OA\JsonContent(type = "array", @OA\Items)
     *      )
     * )
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
     * @OA\Post(
     *      path="/api/countries",
     *      summary="Create a new country",
     *      tags={"Countries"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Country")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Country created successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Country")
     *      )
     * )
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
     * @OA\Get(
     *      path="/api/countries/{id}",
     *      summary="Get a single country",
     *      tags={"Countries"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Country details",
     *          @OA\JsonContent(ref="#/components/schemas/Country")
     *      ),
     *      @OA\Response(response=404, description="Country not found")
     * )
     */

    public function show($id)
    {
        try {
            $country = Country::find($id);

            if($country) {
                return response()->json(['status' => 'success', 'country' => $country], 201);
            } else {
                return response()->json(['message' => 'this country not exist'], 404);
            }
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    /**
     * @OA\Put(
     *      path="/api/countries/{id}",
     *      summary="Update an existing country",
     *      tags={"Countries"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Country")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Country updated successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Country")
     *      ),
     *      @OA\Response(response=404, description="Country not found")
     * )
     */

    public function edit(Country $country)
    {
        //
    }

    /**
     * @OA\Delete(
     *      path="/api/countries/{id}",
     *      summary="Delete a country",
     *      tags={"Countries"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200, description="Country deleted successfully"),
     *      @OA\Response(response=404, description="Country not found")
     * )
     */

    public function update(Request $request, $id)
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
            $country = Country::find($id);

            if(!$country) {
                return response()->json(['message' => 'country not found'], 404);
            }

            $country->update([
                    'country_name' => $validated['country_name'],
                    'capital' => $validated['capital'],
                    'population' => $validated['population'],
                    'region' => $validated['region'],
                    'currency' => $validated['currency'],
                    'language' => $validated['language'],
                    'flag' => $validated['flag'],
            ]);

            return response()->json(['status' => 'success', 'country' => $country], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Country::destroy($id);
        return response()->json(['status' => 'success'], 200);
    }
}
