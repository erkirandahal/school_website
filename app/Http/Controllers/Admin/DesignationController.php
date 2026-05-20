<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Http\Requests\DesignationRequest;

use Sentinel;
use Str;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            if (Sentinel::hasAccess('designations.index')) {
                $setting = defaultSetting();
                $designations = Designation::orderBy('order', 'ASC')->paginate($setting->per_page);
                return view('admin.designation.index', compact('designations'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('designations.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if (Sentinel::hasAccess('designations.create')) {
                return view('admin.designation.create');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('designations.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DesignationRequest $request)
    {
        try {

            if (Sentinel::hasAccess('designations.store')) {

                $requestDetails = $request->only(
                    'name',
                    'name_np',
                    'order'
                );
                $requestDetails['slug'] = Str::slug($request->name);
                Designation::create($requestDetails);
                return redirect()->route('designations.index')->with('success', 'Successfully Created!');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('designations.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {

            if (Sentinel::hasAccess('designations.edit')) {

                $designation = Designation::find($id);
                return view('admin.designation.edit', compact('designation'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('designations.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DesignationRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('designations.update')) {
                $designation = Designation::find($id);
                $requestDetails = $request->only(
                    'name',
                    'name_np',
                    'order'
                );
                $details['slug'] = Str::slug($request->name);
                $designation->update($details);
                return redirect()->route('designations.index')->with('success', 'Successfully Updated!');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('designations.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Sentinel::hasAccess('designations.delete')) {
                Designation::destroy($id);
                return redirect()->route('designations.index')->with('success', 'Successfully Deleted!');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('designations.index')->with('error', 'Oops! Something went wrong.');
        }
    }
}
