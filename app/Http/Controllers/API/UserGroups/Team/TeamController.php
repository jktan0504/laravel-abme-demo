<?php

namespace App\Http\Controllers\API\UserGroups\Team;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\UserGroups\Team\Team;
use App\Http\Resources\UserGroups\Team\TeamResource;
use App\Http\Requests\UserGroups\Team\TeamAddRequest;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // per_page for total pagination
        $per_page_total = $request->input('per_page');
        $teams =  Team::orderBy('id','asc')
                ->paginate($per_page_total);
        return TeamResource::collection($teams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamAddRequest $request)
    {
        $credentials = $request->all();
        try {
            $team = new Team;
            $team->team_name = $request->input('team_name');

            if ($request->input('team_description')) {
                $team->team_description = $request->input('team_description');
            }

            $team->activated = 1;

            $team->save();

            return response()->json(['success' => $team], Response::HTTP_CREATED);
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
        return new TeamResource(Team::findOrFail($id));
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
        $team = Team::findOrFail($id);
        $credentials = $request->all();
        try {

            foreach($credentials as $attribute => $prop) {
                $team->$attribute = $credentials[$attribute];
            }
            $team->save();

            return response()->json(['updated' => $team], Response::HTTP_CREATED);
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
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(['deleted' => $team], Response::HTTP_CREATED);
    }
}
