<?php
namespace App\Http\Controllers;

use Auth;
use View;
use Lang;
use Illuminate\Http\Request;
use Response;
use Validator;
use App\Trip;
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
            "gpx" => "required",
        ]);

        if ($validator->fails()) {
            return redirect("/trip/create")->withErrors($validator->errors())
                                                     ->withInput();
        }

        if($request->hasFile('gpx')) {
            $file = $request->file('gpx');
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $uniqueFileName = uniqid() .'-'. $name;
            $destinationPath = public_path('/uploads');
            
            $file->move($destinationPath, $uniqueFileName);
        }
        
        $gpx = simplexml_load_file($uniqueFileName);
        dd($gpx);
        
        $trip = new Trip();
        $trip->lat = $gpx->lat;
        $trip->lon = $gpx->lon;
        $trip->ele = $gpx->ele;
        $trip->time = $gpx->time;
        
        if ($trip->save()) {
            return redirect("/trip/edit/$trip->id")->with('successfulMessages',[Lang::get('errors.successfullyTrip')]);
        } else {
            return redirect("/trip/create")->withErrors([Lang::get('errors.somethingWrong')]);
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
     * Editing trips information
     * @param  int $id
     * @return Response edit Users name or get an error
     */
      public function postEdit(Request $request, int $id)
      {
          $validator = Validator::make($request->all(), [
              "gpx" => "required",
        ]);

        if ($validator->fails()) {
            return redirect("/trips/edit/$id")->withErrors($validator->errors())
                                                       ->withInput();
        }
          $trip = Trip::find($id);
    
          if ($trip->save()) {
              return redirect("/trip/edit/$trip->id")->with('successfulMessages',[Lang::get('errors.successfullyTrip')]);
          } else {
              return redirect("/trip/edit/$trip->id")->withErrors([Lang::get('errors.somethingWrong')]);
          }
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