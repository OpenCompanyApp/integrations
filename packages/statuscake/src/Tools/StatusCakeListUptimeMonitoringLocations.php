<?php

namespace OpenCompany\Integrations\StatusCake\Tools;

/**
 * Returns a list of locations detailing server information for uptime monitoring servers. This information can be used to create further checks using the API..
 *
 * Maps to the official StatusCake endpoint GET /uptime-locations.
 */
class StatusCakeListUptimeMonitoringLocations extends AbstractStatusCakeTool
{
    protected const NAME = 'statuscake_list_uptime_monitoring_locations';
    protected const DESCRIPTION = 'Returns a list of locations detailing server information for uptime monitoring servers. This information can be used to create further checks using the API.

Official StatusCake endpoint: GET /uptime-locations.';
    protected const PARAMETERS = array (
      'region_code' => array (
        'type' => 'string',
        'description' => 'Server region code',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/uptime-locations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'region_code' => 'region_code',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
