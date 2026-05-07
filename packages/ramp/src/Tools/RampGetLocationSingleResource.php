<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a location.
 *
 * Maps to the official Ramp endpoint get /developer/v1/locations/{location_id}.
 */
class RampGetLocationSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_location_single_resource';
    protected const DESCRIPTION = 'Fetch a location

Official Ramp endpoint: GET /developer/v1/locations/{location_id}';
    protected const PARAMETERS = array (
  'location_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `location_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/locations/{location_id}';
    protected const PATH_PARAMS = array (
  'location_id' => 'location_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
