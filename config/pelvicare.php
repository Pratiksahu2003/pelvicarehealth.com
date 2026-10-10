<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pelvicare – Indian States & Union Territories (Single Source of Truth)
    |--------------------------------------------------------------------------
    |
    | Used globally across the site: search bar, doctor listing, booking
    | location filter, doctor profile creation, and admin verification panel.
    | DO NOT add cities, districts, or free-text entries here.
    | Format: 'LocationName' => 'type'   (state | union_territory)
    |
    */

    'locations' => [
        // ── Indian States ────────────────────────────────────────────────────
        'Andhra Pradesh'      => 'state',
        'Arunachal Pradesh'   => 'state',
        'Assam'               => 'state',
        'Bihar'               => 'state',
        'Chhattisgarh'        => 'state',
        'Goa'                 => 'state',
        'Gujarat'             => 'state',
        'Haryana'             => 'state',
        'Himachal Pradesh'    => 'state',
        'Jharkhand'           => 'state',
        'Karnataka'           => 'state',
        'Kerala'              => 'state',
        'Madhya Pradesh'      => 'state',
        'Maharashtra'         => 'state',
        'Manipur'             => 'state',
        'Meghalaya'           => 'state',
        'Mizoram'             => 'state',
        'Nagaland'            => 'state',
        'Odisha'              => 'state',
        'Punjab'              => 'state',
        'Rajasthan'           => 'state',
        'Sikkim'              => 'state',
        'Tamil Nadu'          => 'state',
        'Telangana'           => 'state',
        'Tripura'             => 'state',
        'Uttar Pradesh'       => 'state',
        'Uttarakhand'         => 'state',
        'West Bengal'         => 'state',

        // ── Union Territories ────────────────────────────────────────────────
        'Andaman and Nicobar Islands' => 'union_territory',
        'Chandigarh'                  => 'union_territory',
        'Dadra and Nagar Haveli and Daman and Diu' => 'union_territory',
        'Delhi'                       => 'union_territory',
        'Delhi NCR'                   => 'union_territory',
        'Jammu and Kashmir'           => 'union_territory',
        'Ladakh'                      => 'union_territory',
        'Lakshadweep'                 => 'union_territory',
        'Puducherry'                  => 'union_territory',
    ],

    /*
    |--------------------------------------------------------------------------
    | Helper: get only the names as a flat array (for dropdowns, filters)
    |--------------------------------------------------------------------------
    */
    // Use  array_keys(config('pelvicare.locations'))  wherever you need names.

];
