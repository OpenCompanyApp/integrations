<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get trip.
 *
 * Maps to the official Brex endpoint get /v1/trips/{trip_id}.
 */
class BrexTravelGetTrip extends AbstractBrexTool
{
    protected const NAME = 'brex_travel_get_trip';
    protected const DESCRIPTION = 'Get trip

Official Brex endpoint: GET /v1/trips/{trip_id}

Retrieves a trip by ID.';
    protected const PARAMETERS = array (
  'trip_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `trip_id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/trips/{trip_id}';
    protected const PATH_PARAMS = array (
  'trip_id' => 'trip_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
