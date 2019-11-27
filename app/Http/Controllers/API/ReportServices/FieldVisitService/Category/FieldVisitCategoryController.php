<?php

namespace App\Http\Controllers\API\ReportServices\FieldVisitService\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\UserGroup\User\User;
use App\Models\Reports\FieldVisitService\FieldVisitCategory;
use App\Http\Resources\ReportServices\FieldVisitService\Category\FieldVisitCategoryResource;
use App\Http\Requests\ReportServices\FieldVisitService\Category\FieldVisitCategoryAddRequest;


class FieldVisitCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page');

        return FieldVisitCategoryResource::collection(FieldVisitCategory::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldVisitCategoryAddRequest $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $credentials = $request->all();

        try {
            $field_visit_category = new FieldVisitCategory;
            $field_visit_category->category_name = $request->input('category_name');

            if($request->input('category_description')){
                $field_visit_category->category_description = $request->input('category_description');
            }
            $field_visit_category->created_by = $user_id;
            $field_visit_category->save();

            return response()->json(['success' => $field_visit_category], Response::HTTP_CREATED);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e], Response::HTTP_NOT_ACCEPTABLE);
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
        return new FieldVisitCategoryResource(FieldVisitCategory::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $field_visit_category = FieldVisitCategory::findOrFail($id);
        $credentials = $request->all();

        try {

            foreach($credentials as $attribute => $prop) {
                $field_visit_category->$attribute = $credentials[$attribute];
            }

            $field_visit_category->updated_by = $user_id;
            $field_visit_category->save();

            return response()->json(['updated' => $field_visit_category], Response::HTTP_CREATED);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e], Response::HTTP_NOT_ACCEPTABLE);
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
        $field_visit_category = FieldVisitCategory::findOrFail($id);
        $field_visit_category->delete();

        return response()->json(['deleted' => $field_visit_category], Response::HTTP_CREATED);
    }
}
