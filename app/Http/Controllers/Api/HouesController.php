<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HouesController extends Controller
{
    public function get_all()
    {
        return House::with(['user'])->get();
    }

    public function get_house(Request $request)
    {
        $house = House::with(['user'])->where($request->subject, $request->value)->firstOrFail();
        return $house;
    }

    public function update_house(Request $request)
    {
        $request->merge([
            'floors' => $this->renderFloor(json_decode($request->floors)),
            'imagesDeleted' => json_decode($request->imagesDeleted, true),
            'address' => [
                'state' => json_decode($request->address)->state,
                'city' => json_decode($request->address)->city,
                'street' => json_decode($request->address)->street,
                'zip_code' => json_decode($request->address)->zip_code,
            ],
            'surfaceArea' => [
                'lot_size' => json_decode($request->surfaceArea)->lot_size,
                'building_size' => json_decode($request->surfaceArea)->building_size,
            ],
        ]);
        $request->validate([
            'title' => 'required',
            'address' => 'required',
            'price' => 'required|numeric',
            'listed_for' => 'required|in:rent,sell',
            'status' => 'in:active,pending,unavailable',
            'measurement_unit' => 'required|in:meter,foot',
            'surfaceArea' => 'array',
            'surfaceArea.building_size' => 'required|numeric',
            'surfaceArea.lot_size' => 'required|numeric',
            'property_type' => '',
            'map_link' => '',

            'floors' => 'array|min:1',
            'floors.*.rooms' => 'required|numeric',
            'floors.*.showers' => 'required|numeric',
            'floors.*.surfaceArea.value' => 'required|numeric',
        ]);
        DB::beginTransaction();
        try {
            /**
             * delete current images
             */
            foreach ($request->imagesDeleted as $key => $image) {
                Storage::disk('public')->delete($image['result']);
            }

            /**
             * $key is the key for the uploaded file
             * $file is an instance of \Illuminate\Http\UploadedFile
             */
            foreach ($request->files->all() as $key => $file) {
                // render the image path and get the image file content
                $path = 'users/user_' . $request->user_id . '/houses/house_' . $request->id . '/' . $key . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')
                    ->put($path, file_get_contents($file->getRealPath()));
            }

            $house = House::where('id', $request->id)->firstOrFail();

            $house->update([
                'title' => $request->title,
                'user_id' => $request->user_id,
                'address' => $request->address,
                'status' => $request->status,
                'description' => $request->description ? $request->description : null,
                'selectedImage' => $request->selectedImage,
                'specification' => [
                    'price' => $request->price,
                    'listed_for' => $request->listed_for,
                    'property_type' => $request->property_type,
                    'measurement_unit' => $request->measurement_unit,
                    'surfaceArea' => $request->surfaceArea,
                    "floors" => $request->floors,
                ],
            ]);

            DB::commit();
            return response()->json([
                'message' => 'House '.$request->title.' successfully update ',
                '_t' => true,
                '_r'=>'list_houses'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            // dd($exception->getMessage());
            return response()->json([
                'message' => 'an error occurred while attempt to update',
                'dev_message' => $exception->getMessage(),
                '_t' => 'Attention',
                '_i' => 'danger'
            ], 403);
        }

    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->merge([
            'floors' => $this->renderFloor(json_decode($request->floors)),
            'address' => [
                'state' => json_decode($request->address)->state,
                'city' => json_decode($request->address)->city,
                'street' => json_decode($request->address)->street,
                'zip_code' => json_decode($request->address)->zip_code,
            ],
            'surfaceArea' => [
                'lot_size' => json_decode($request->surfaceArea)->lot_size,
                'building_size' => json_decode($request->surfaceArea)->building_size,
            ],
        ]);
        // dd($request);
        $request->validate([
            'title' => 'required',
            'address' => 'required',
            'price' => 'required|numeric',
            'listed_for' => 'required|in:rent,sell',
            'status' => 'in:active,pending,unavailable',
            'measurement_unit' => 'required|in:meter,foot',
            'surfaceArea' => 'array',
            'surfaceArea.building_size' => 'required|numeric',
            'surfaceArea.lot_size' => 'required|numeric',
            'property_type' => '',
            'map_link' => '',

            'floors' => 'array|min:1',
            'floors.*.rooms' => 'required|numeric',
            'floors.*.showers' => 'required|numeric',
            'floors.*.surfaceArea.value' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            // get the next house's id so that the folder's name should have that id for example houses/house_1/
            $result = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?", [env('DB_DATABASE'), 'houses']);
            $nextID = $result[0]->AUTO_INCREMENT;
            /**
             * $key is the key for the uploaded file
             * $file is an instance of \Illuminate\Http\UploadedFile
             */
            foreach ($request->files->all() as $key => $file) {
                // render the image path and get the image file content
                $path = 'users/user_' . auth()->id() . '/houses/house_' . $nextID . '/' . $key . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($path, file_get_contents($file->getRealPath()));
            }
            $house = new House();
            $house->title = $request->title;
            $house->user_id = auth()->user()->id;
            $house->address = $request->address;
            $house->status = $request->status;
            $house->description = $request->description ? $request->description : null;
            $house->selectedImage = $request->selectedImage;
            $house->specification = [
                'price' => $request->price,
                'listed_for' => $request->listed_for,
                'property_type' => $request->property_type,
                'measurement_unit' => $request->measurement_unit,
                'surfaceArea' => $request->surfaceArea,
                "floors" => $request->floors,
            ];
            $house->save();
            DB::commit();
            return response()->json([
                'message' => 'New house successfully created ', '_t' => true,
                '_r'=>'list_houses'
            ]);

        } catch (\Exception $exception) {
            DB::rollBack();
            // dd($exception->getMessage());
            return response()->json([
                'message' => 'an error occurred while attempt creating new houes',
                '_t' => 'Attention',
                '_i' => 'danger'
            ], 403);
        }
    }

    private function renderFloor($floors): array
    {
        $output = [];
        foreach ($floors as $floor) {
            $output[] = [
                "rooms" => $floor->rooms,
                "showers" => $floor->showers,
                "surfaceArea" => [
                    "value" => $floor->surfaceArea->value,
                ],
                "description" => $floor->description
            ];
        }
        return $output;
    }
}
