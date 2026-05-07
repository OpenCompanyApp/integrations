<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a list of locations detailing server information for pagespeed monitoring servers. This information can be used to create further checks using the API..
 *
 * Maps to the official StatusCake endpoint GET /pagespeed-locations.
 */
class StatusCakeListPagespeedMonitoringLocations extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_list_pagespeed_monitoring_locations';
    protected const DESCRIPTION = 'Returns a list of locations detailing server information for pagespeed monitoring servers. This information can be used to create further checks using the API.

Official StatusCake endpoint: GET /pagespeed-locations.';
    protected const PARAMETERS = array (
      'location' => array (
        'type' => 'string',
        'description' => 'Alpha-2 ISO 3166-1 country code',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/pagespeed-locations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'location' => 'location',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
