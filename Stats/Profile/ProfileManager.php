<?php

/**
 * A helper class for abstracting all profile functions.
 *
 * Provides a single interface for managing profiles.
 */
namespace R115\Profile;

use App\Models\Profile;

class ProfileManager {
    /**
     * Create a new profile
     *
     * @param array $payload
     *
     * @return Profile
     */
    public function create(array $payload) : Profile {
        $profile = new Profile();
        $profile->first_name = $payload['first_name'];

        if (array_key_exists('middle_name', $payload)){
            $profile->middle_name = $payload['middle_name'];
        }

        if (array_key_exists('last_name', $payload)){
            $profile->middle_name = $payload['last_name'];
        }

        $profile->save();

        return $profile;
    }
}
