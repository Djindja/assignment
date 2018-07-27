<?php
namespace App\Http\Controllers;

use Auth;
use View;
use Lang;
use Illuminate\Http\Request;
use Response;
use Validator;
use Exception;
use App\Trip;
use Carbon\Carbon;
use App\TripPath;
use Illuminate\Support\Facades\Input;

class TripController extends Controller
{
    /**
   * Index page for trips
   * @return View
   */
    public function index()
    {
      return View::make('admin.trip.index')->with('trips', Trip::all());
    }
    /**
     * Page for creating new trip
     * @return View
     */
    public function create()
    {
        return View::make('admin.trip.create');
    }
    /**
     * Method for handling trips creation
     * @return  Redirect
     */
    public function postCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "gpx" => "required|file",
        ]);

        if ($validator->fails()) {
            return redirect("/trip/create")->withErrors($validator->errors())
                                                     ->withInput();
        }

        try {
            $file = $request->file('gpx');
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $uniqueFileName = uniqid() .'-'. $name;
            $destinationPath = public_path('/uploads');
            
            $file->move($destinationPath, $uniqueFileName);

            $gpx = simplexml_load_file($destinationPath . '/' . $uniqueFileName);

            $trip = new Trip();
            $trip->user_id = Auth::user()->id;
            $trip->filename = $uniqueFileName;
            $trip->save();

            foreach($gpx->trk->trkseg->trkpt as $g) {
                $coordinates = $g->attributes();
                
                $tripPath = new TripPath();
                $tripPath->lat = $coordinates['lat'];
                $tripPath->lon = $coordinates['lon'];
                $tripPath->ele = $g->ele;
                $tripPath->time = Carbon::parse($g->time)->format('Y-m-d h:i:s');
                $tripPath->trip_id = $trip->id;

                $tripPath->save();
               
            }
            
            return redirect("/trip/edit/$trip->id")->with('successfulMessages',[Lang::get('errors.successfullyTrip')]);
        
        }  catch(Exception $e) {
            return redirect("/trip/create")->withErrors([Lang::get($e->getMessage())]);
        }
    }
    /**
     * [edit description]
     * @param  int $id
     * @return mixed   If trip is null, Response is returned else View is returned
     */
    public function edit(int $id)
    {
        $trip = Trip::find($id);

        if (is_null($trip)) {
            return redirect("/trip");
        }
        return View::make('admin.trip.edit')->with('trip', $trip);
    }

    /**
     * Delete trip
     * @param  int $id
     * @return Response Remove User or get an error
     */
    public function delete(int $id)
    {
        $trip = Trip::find($id);

        if ($trip->delete()) {
            return redirect("/trip");
        } else {
            return redirect("/trip")->withErrors([Lang::get('errors.somethingWrong')]);
        }
    }
}