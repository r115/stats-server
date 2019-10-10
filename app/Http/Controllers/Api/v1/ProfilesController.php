<?php

/**
 * Resource controller for the profiles.
 *
 * @todo Implement fractals
 * @todo Write integration tests
 * @todo Code optimization
 */

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use R115\Profile\ProfileManager;

class ProfilesController extends Controller {
    /**
     * Initialize the profile manager.
     *
     * @var ProfileManager
     */
    protected $manager;

    function __construct()
    {
       $this->manager = new ProfileManager();
    }

    /**
     * Create a new profile
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required|max:25',
            'last_name' => 'max:25',
            'middle_name' => 'max:25'
        ]);

        if (auth()->user()->can('create', Profile::class)) {
            $profile = $this->manager->create($request->all());

            return response()->json($profile);
        }

        app()->abort(403);
    }

    /**
     * Show a single profile
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        $profile = $this->manager->find($id);

        if ($profile) {
            return response()->json($profile);
        }

        app()->abort(404);
    }
}
