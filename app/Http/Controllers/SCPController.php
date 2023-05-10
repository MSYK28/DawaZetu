<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Product;
use App\Models\SCP;
use App\Models\StoreTopUp;
use App\Models\StoreTopUpDetails;
use Illuminate\Http\Request;

class SCPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Facility::all();
        $topups = StoreTopUp::all();
        return view('scp.index', compact('topups', 'facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SCP  $sCP
     * @return \Illuminate\Http\Response
     */
    public function show(SCP $sCP, $id)
    {
        $storetopup = StoreTopUp::find($id);
        $storetopupDetails = StoreTopUpDetails::where('requested_by', '=', $storetopup->requested_by)->get();

        $facilities = Facility::all();
        $products = Product::all();

        return view('scp.show', compact(['storetopup', 'storetopupDetails', 'facilities', 'products']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SCP  $sCP
     * @return \Illuminate\Http\Response
     */
    public function edit(SCP $sCP, $id)
    {
        $storetopup = StoreTopUp::find($id);
        $storetopupDetails = StoreTopUpDetails::where('requested_by', '=', $storetopup->requested_by)->get();

        $facilities = Facility::all();
        $products = Product::all();

        return view('scp.edit', compact(['storetopup', 'storetopupDetails', 'facilities', 'products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SCP  $sCP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SCP $sCP, $id)
    {
        $storetopup = StoreTopUp::find($id);
        $storetopup->status = 'Processing';
        $storetopup->update();

        $topupCount = count($request->product_name);

        for ($i=0; $i < $topupCount; $i++) { 
            $topupDetails = new SCP();
            $topupDetails->product_name = $request->product_name[$i];
            $topupDetails->strength = $request->strength[$i];
            $topupDetails->unit_of_issue = $request->unit_of_issue[$i];
            $topupDetails->unit_size = $request->unit_size[$i];
            $topupDetails->available_units = $request->available_units[$i];
            $topupDetails->requested_units = $request->requested_units[$i];
            $topupDetails->allocated_units = $request->allocated_units[$i];

            $topupDetails->requested_by = $request->requested_by;
            $topupDetails->request_date = $request->request_date;
            $topupDetails->status = 'Processing';
            $topupDetails->request_id = $request->request_id;
            $topupDetails->save();
        }

        return redirect('/scp')->with('status', 'Product Top Up processed successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SCP  $sCP
     * @return \Illuminate\Http\Response
     */
    public function destroy(SCP $sCP)
    {
        //
    }
}
