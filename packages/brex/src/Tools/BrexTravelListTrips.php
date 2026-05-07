<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List trips.
 *
 * Maps to the official Brex endpoint get /v1/trips.
 */
class BrexTravelListTrips extends AbstractBrexTool
{
    protected const NAME = 'brex_travel_list_trips';
    protected const DESCRIPTION = 'List trips

Official Brex endpoint: GET /v1/trips

Lists trips according to the filters passed in the query string.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'last_updated_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `last_updated_after` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/trips';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'last_updated_after' => 'last_updated_after',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
