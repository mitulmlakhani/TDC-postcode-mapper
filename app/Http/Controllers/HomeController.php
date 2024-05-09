<?php

namespace App\Http\Controllers;

use App\Imports\LocationsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    function index()
    {
        return view('markers');
    }

    function import()
    {
        return view('import');
    }

    function importSave(Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);
 
        $rows = (new LocationsImport)->toArray($request->file);
        $rows = $rows[0] ?? [];
        $locations = [];
        $failedRows = [];
        $i = 1;

        foreach ($rows as $row) {
            try {
                $address = implode(", ", array_values($row));

                $url = "https://geocode.maps.co/search?api_key=6636148dc6f8a965485722bzxd2cd86&q=$address";

                $response = Http::get($url);

                if (!$response->ok()) {
                    $failedRows[] = $i;
                    $i++;
                    continue;
                }

                $data = $response->json();

                if (is_array($data) && count($data)) {
                    $lat = $data[0]['lat'];
                    $lon = $data[0]['lon'];

                    $locations[] = [
                        "latitude" => $lat,
                        "longitude" => $lon,
                        "title" => $address
                    ];
                }

            } catch (\Throwable $th) {
                $failedRows[] = $i;
            }

            $i++;
            sleep(1.5);
        }

        try {
            $path = storage_path() . "/app/public/markers.json";
            $json = json_decode(file_get_contents($path), true) ?: [];
    
            file_put_contents(storage_path() . "/app/public/markers.json", json_encode(array_merge($json, $locations)));    

            $failedMessage = count($failedRows) ? 'Failed rows ' . implode(", ", $failedRows) : 'All Synced.';

            return redirect()->route('import')->with('success', 'Import Done! ' . $failedMessage);
        } catch (\Throwable $th) {
            return redirect()->route('import')->with('danger', $th->getMessage());
        }
    }

    function clearLocation()
    {
        file_put_contents(storage_path() . "/app/public/markers.json", json_encode([]));

        return redirect()->route('import')->with('success', 'All Locations Removed!');
    }

    function updateMarkersFile()
    {
        return view('update');
    }

    function changeMarkersFile(Request $request)
    {
        $request->validate([
            'content' => 'required|json'
        ]);

        Storage::put('markers.json', $request->content);

        return redirect()->route('update_markers')->with('success', 'Done!');
    }

    function downloadMarkers()
    {
        return Storage::download('markers.json');
    }
}
