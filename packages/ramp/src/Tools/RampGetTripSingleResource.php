<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a trip.
 *
 * Maps to the official Ramp endpoint get /developer/v1/trips/{trip_id}.
 */
class RampGetTripSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_trip_single_resource';
    protected const DESCRIPTION = 'Fetch a trip

Official Ramp endpoint: GET /developer/v1/trips/{trip_id}';
    protected const PARAMETERS = array (
  'trip_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `trip_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/trips/{trip_id}';
    protected const PATH_PARAMS = array (
  'trip_id' => 'trip_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
