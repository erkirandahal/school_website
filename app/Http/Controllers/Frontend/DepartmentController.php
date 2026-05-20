<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\DepartmentRequest;

use App\Models\Frontend\Department;

use App\Managers\CommonDataManager;
use App\Managers\Frontend\DepartmentManager;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class DepartmentController extends Controller
{
    protected $departmentManager;
    protected $commonDataManager;

    function __construct(
        DepartmentManager $departmentManager,
        CommonDataManager $commonDataManager
    ) {
        $this->departmentManager = $departmentManager;
        $this->commonDataManager = $commonDataManager;
    }

    public function index()
    {
        try {
            $setting = defaultSetting();
            $params['title'] = null;
            $params['status'] = null;
            $statusOptions = $this->commonDataManager->publishStatusDropdown();
            if (request()->ajax()) {
                $params = request()->only('title', 'status');
                $departments = $this->departmentManager->all($params, $setting->per_page);
                return  view('site_modules.departments.replace_index', compact('departments', 'setting', 'statusOptions'));
            }
            if (Sentinel::hasAccess('departments.index')) {
                $departments = $this->departmentManager->all($params, $setting->per_page);
                return view('site_modules.departments.index', compact('departments', 'setting', 'statusOptions'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Oops, Something went wrong!!!');
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

            if (Sentinel::hasAccess('departments.create')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                return view('site_modules.departments.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('departments.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {

        try {

            if (Sentinel::hasAccess('departments.store')) {
                DB::beginTransaction();
                $details = $request->only('title', 'title_np', 'order', 'status');
                $details['slug'] = Str::slug($request->title);
                $department = Department::create($details);
                DB::commit();
                return redirect()->route('departments.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('departments.index')->with('error', 'Oops! Something went wrong.');
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

        try {

            if (Sentinel::hasAccess('departments.view')) {
                $department = Department::find($id);
                return view('site_modules.departments.view', compact('department'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('departments.index')->with('error', 'Oops! Something went wrong.');
        }
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

            if (Sentinel::hasAccess('departments.edit')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $department = Department::find($id);
                return view('site_modules.departments.edit', compact('data', 'department'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('departments.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('departments.update')) {
                DB::beginTransaction();
                $details = $request->only('title', 'title_np', 'order', 'status');
                $details['slug'] = Str::slug($request->title);
                $department = Department::find($id);
                $department->update($details);
                DB::commit();
                return redirect()->route('departments.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('departments.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('departments.delete')) {
                $department = Department::find($id);
                $department->delete();
                return redirect()->route('departments.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('departments.index')->with('error', 'Oops! Something went wrong.');
        }
    }
}
