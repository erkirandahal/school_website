<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Http\Requests\Frontend\PostCategoryRequest;

use App\Models\Frontend\PostCategory;

use App\Managers\CommonDataManager;
use App\Managers\Frontend\PostCategoryManager;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{
    protected $postCategoryManager;
    protected $commonDataManager;

    function __construct(
        PostCategoryManager $postCategoryManager,
        CommonDataManager $commonDataManager,
    ) {
        $this->postCategoryManager = $postCategoryManager;
        $this->commonDataManager = $commonDataManager;
    }

    public function index()
    {
        try {
            if (request()->ajax()) {
                $setting = defaultSetting();
                $params = request()->only('title');
                $post_categories = $this->postCategoryManager->all($params, $setting->per_page);
                return  view('site_modules.post_categories.replace_index', compact('post_categories'));
            }


            if (Sentinel::hasAccess('post-categories.index')) {

                $setting = defaultSetting();
                $params['title'] = null;
                $post_categories = $this->postCategoryManager->all($params, $setting->per_page);
                return view('site_modules.post_categories.index', compact('post_categories'));
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

            if (Sentinel::hasAccess('post-categories.create')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                return view('site_modules.post_categories.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('post-categories.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request)
    {

        try {

            if (Sentinel::hasAccess('post-categories.store')) {
                DB::beginTransaction();
                $postCategoryDetails = $request->only('title', 'title_np', 'order', 'status');
                $postCategoryDetails['slug'] = Str::slug($request->title);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/post_categories/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $postCategoryDetails['image'] = $fileName;
                }

                $post_category = PostCategory::create($postCategoryDetails);
                DB::commit();
                return redirect()->route('post-categories.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('post-categories.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('post-categories.view')) {
                $post_category = PostCategory::find($id);
                return view('site_modules.post_categories.view', compact('post_category'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('post-categories.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('post-categories.edit')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $post_category = PostCategory::find($id);
                return view('site_modules.post_categories.edit', compact('data', 'post_category'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('post-categories.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('post-categories.update')) {
                DB::beginTransaction();
                $postCategoryDetails = $request->only('title', 'status', 'order');
                $postCategoryDetails['slug'] = Str::slug($request->title);
                $post_category = PostCategory::find($id);


                $post_category->update($postCategoryDetails);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/post_categories/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_image = $post_category->image;

                    $post_category->update(['image' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/post_categories/' . $old_image);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }
                DB::commit();
                return redirect()->route('post-categories.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('post-categories.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('post-categories.delete')) {
                $post_category = PostCategory::find($id);

                $slug = $post_category->slug;

                $seedData = ['notices', 'news', 'results'];

                if (!in_array($slug, $seedData)) {

                    // Remove  old file
                    $oldPath = public_path('uploads/post_categories/' . $post_category->image);
                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }

                    $post_category->delete();
                    return redirect()->route('post-categories.index')->with('success', 'Operation Successfull');
                }
                return redirect()->route('post-categories.index')->with('warning', 'Delete not allowed !');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('post-categories.index')->with('error', 'Oops! Something went wrong.');
        }
    }
}
