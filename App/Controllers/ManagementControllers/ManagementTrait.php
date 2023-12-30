<?php

namespace App\Controllers\ManagementControllers;

trait ManagementTrait
{
    /**
     * Accepts the request array to return true if not empty and false otherwise
     * @param array $request
     * @return bool
     */
    public function accept_request(array $request): bool
    {
        $is_valid = true;

        if( empty($request)){
            $is_valid = false;
        }

        return $is_valid;
    }
}